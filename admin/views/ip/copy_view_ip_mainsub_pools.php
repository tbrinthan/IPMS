<div id="ippooldetails" class="content-box" > <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
<div class="content-box-content">
    <div class="content-box-header">
        <h3>Details of Main IP Pool [ <?php echo $pool_value['pool_values'];?> ] </h3>
    </div>
       <div class="clear">
<p></p>
       </div>

        <table class="sample" width="500Px" border="1Px"  >

            <thead style="font-variant: small-caps ;    ">
            <tr>
                <th style="text-align: center">SubPooL ID</th>
                <th>IP Block</th>
                <th style="text-align: center">CIDR</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th style="text-align: center">Status</th>
            </tr>

            </thead>
<span></span>
            <tbody>
            <?php
//            $this->ip_model->setPoolID($pool_id);
//            $ip_mainsub_pools= $this->ip_model->getMainSubPrimaryPools();




            foreach($ip_mainsub_pools as $rowmain){?>
            <tr >
                <td style="text-align: center"><?php echo $rowmain->sub_pool_id;?></td>
                <td><?php echo $rowmain->sub_pool_values;?></td>
                <td style="text-align: center" ><?php echo $rowmain->subnet;?></td>
                <td><?php if($rowmain->category_name != null) echo $rowmain->category_name; else echo "N/A";?></td>
                <td><?php if($rowmain->ssid != null) echo $rowmain->ssid; else echo "N/A";?></td>
                <td style="text-align: center"><?php if($rowmain->status){
                    echo "<img src = \""?><?php echo base_url();?><?php echo "admin_resources/images/icons/notavailable.png\" alt=\"Not Available\"  />"; }
                else{  echo "<img src = \""?><?php echo base_url();?><?php echo "admin_resources/images/icons/available.png\" alt=\"Available\" />";}
                    ?>
                </td>

            </tr>
            <?php }?>


            </tbody>



        </table>

        <?php echo $page_link;?>



</div> <!-- End #messages -->
</div>