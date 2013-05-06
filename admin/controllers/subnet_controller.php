<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subnet_controller extends CI_Controller {

    public $address, $dot1, $dot2, $dot3;

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = '';
        $this->load->view('welcome_message', $data);
    }

    public function subnet() {

        $cidr_address = trim($this->input->post('cidr'));
//        $slash = strpos($cidr_address, '/');
//        $ip = substr($cidr_address, 0, $slash);
//        $netbits = substr($cidr_address, $slash + 1);
        $subnet=trim($this->input->post('subnet'));
        if (strpos($cidr_address, '/') != FALSE) {
            
            $test = explode('/', $cidr_address);
            $ip = ip2long($test[0]);
            $netbits = $test[1];



//            $mask=ip2long($cidr_address);
//            print_r($cidr_address);

            if ($ip == -1 || $ip === FALSE) {
                echo "Invalid address, please try again.";
            } else {
////                mask to cidr
//                $base=((1<<32)-1);
//                $result= 32-log(($long^$base)+1,2);
//                cidr to mask
                /* ip2long means: 1*256^0 + 0*256^1 + 168*256^2 + 192*256^3
                 *
                 * 192.168.0.1--->3232235521
                 *
                 * */
                $mask = ip2long('255.255.255.255') << (32 - (int) $netbits);
//            $wildcard = long2ip(~(-1 << (32 - (int) $netbits)));
                $wildcard = ~$mask;
                $network = ($ip & $mask);
                $broadcast = ($ip | ~($mask));
//            echo long2ip($ip) . "<br>";
                echo "Network:      " . long2ip($network) . "<br>";
//            echo $netbits . "<br>";
                echo "Subnetmas:    " . long2ip($mask) . "<br>";
                echo "Wildcard:     " . long2ip($wildcard) . "<br>";
                echo "Broadcast:    " . long2ip($broadcast) . "<br>";
                echo "Hostmin:      " . long2ip($network + 1) . "<br>";
                echo "Hostmax:      " . long2ip($broadcast - 1) . "<br>";
//                print_r($this->iprange(long2ip($ip), $netbits));
                echo "<br>";

                if($subnet!=''){
                    $length=1<<($subnet-$netbits);
                    $d=1<<(32-$subnet);
                    $ips=array();
                    for($i=0;$i<=$length-1;$i++){
                        $t=$d*$i;
                        $ips[]=long2ip($network+$t);
                        echo "Network: ".$ips[$i]."<br>";
                    }

                    print_r($ips);
                }

            }
        }
        else{
            echo "type in cidr format";
        }
    }

//   function iprange($ip, $mask, $return_array=FALSE) {
//        $corr = (pow(2, 32) - 1) - (pow(2, 32 - $mask) - 1);
//        $first = ip2long($ip) & ($corr);
//        $length = pow(2, 32 - $mask) - 1;
//        if (!$return_array) {
//            return array(
//                'first' => $first,
//                'size' => $length + 1,
//                'last' => $first + $length,
//                'first_ip' => long2ip($first),
//                'last_ip' => long2ip($first + $length)
//            );
//        }
//        $ips = array();
//        for ($i = 0; $i <= $length; $i++) {
//            $ips[] = long2ip($first + $i);
//        }
//        return $ips;
//    }

}

?>