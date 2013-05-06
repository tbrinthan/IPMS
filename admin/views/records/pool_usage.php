<html>
<head>

    
    <script type="text/javascript">
        
        $(document).ready(function()
        {
	// We'll target all AREA elements with alt tags (Don't target the map element!!!)
	$('img[alt]').qtip(
	{
		content: {
			attr: 'alt' // Use the ALT attribute of the area map for the content
		},
		style: {
			classes: 'ui-tooltip-tipsy ui-tooltip-shadow'
		}
	});
        });
        simpla_datatable.dt2();
        simpla_datatable.dt_actions_fb();

</script>

</head>

<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header" style="height: 50px">

        <h3><?=$title?></h3>

    </div> <!-- End .content-box-header -->

    <div class="content-box-content">
        <div id="container" >
            
            <div id="ip_pools" style="display: block;">

                <h3 style="margin-top: 10px;text-align: center;font-weight: bolder;font-size: 1.2em">IP Pool Usage</h3>

                <hr>
              
                <form id="ippool_form"  class="records">
                    <table id="dt2" class="display">
                    <thead>
                    <tr>
                        
                        <th style="font-size: 12px">ID</th>
                        <th style="font-size: 12px">START IP</th>
                        <th style="font-size: 12px">LENGTH</th>
                        <th style="font-size: 12px">USAGE</th>
                        <th style="font-size: 12px">ASSIGNMENT STATUS</th>
                    </tr>
                    </thead>
                    
                    <tfoot>

                </tfoot>

                <tbody>
                <?php
                    
                     foreach($ippools as $row){?>
                    <tr id="<?php echo $row->pool_id;?>">
                    <td><?php echo $row->pool_id;?></td>
                    <td>
                        <a style="cursor: pointer;color: black;"title="Allocation" onclick="openchart(<?php echo $row->pool_id;?>)">
                        <?php echo $row->pool_values;?></a>
                    </td>
                    <td><?php echo $row->subnet;?></td>
                    <td><?php echo $temp1[$row->pool_id]." % Usage";?></td>
                
                    <td style="text-align: left;">
                        <?php 
                        $this->usage_model->setPoolid($row->pool_id);
                        foreach ($temp2[$row->pool_id] as $key => $value){
                            $this->usage_model->setParentid($key);
                            $details=$this->usage_model->get_primaryblock();
                            if($value<15){
                                  if(!($this->usage_model->check_assigned_blocks_parentip()))  
                                    echo '<img style="float: left; padding:0 5px 10px 0px;"  src="'.base_url().'admin_resources/images/colors_percent/00.png" alt="Not Allocated" width="10px"/>';  
                                  else
                                    echo '<img style="float: left; padding:0 5px 10px 0px;cursor:pointer;"  src="'.base_url().'admin_resources/images/colors_percent/0.png" 
                                        alt="Block: '.$details['sub_pool_values'].'/'.$details['subnet'].'</br>Usage: '.$temp3[$row->pool_id][$key].'%"  width="10px"/>';  
                            }
                            else if($value<30){
                               echo '<img style="float: left; padding:0 5px 10px 0px;cursor:pointer;" src="'.base_url().'admin_resources/images/colors_percent/15.png" 
                                        alt="Block: '.$details['sub_pool_values'].'/'.$details['subnet'].'</br>Usage: '.$temp3[$row->pool_id][$key].'%"  width="10px"/>';  
                            }
                            else if($value<45){
                               echo '<img style="float: left; padding:0 5px 10px 0px;cursor:pointer;" src="'.base_url().'admin_resources/images/colors_percent/30.png" 
                                        alt="Block: '.$details['sub_pool_values'].'/'.$details['subnet'].'</br>Usage: '.$temp3[$row->pool_id][$key].'%"  width="10px"/>';  
                            }
                            else if($value<60){
                               echo '<img style="float: left; padding:0 5px 10px 0px;cursor:pointer;" src="'.base_url().'admin_resources/images/colors_percent/45.png" 
                                        alt="Block: '.$details['sub_pool_values'].'/'.$details['subnet'].'</br>Usage: '.$temp3[$row->pool_id][$key].'%"  width="10px"/>';  
                            }
                            else if($value<75){
                               echo '<img style="float: left; padding:0 5px 10px 0px;cursor:pointer;" src="'.base_url().'admin_resources/images/colors_percent/60.png" 
                                        alt="Block: '.$details['sub_pool_values'].'/'.$details['subnet'].'</br>Usage: '.$temp3[$row->pool_id][$key].'%"  width="10px"/>';  
                            }
                            else if($value<90){
                               echo '<img style="float: left; padding:0 5px 10px 0px;cursor:pointer;" src="'.base_url().'admin_resources/images/colors_percent/75.png" 
                                        alt="Block: '.$details['sub_pool_values'].'/'.$details['subnet'].'</br>Usage: '.$temp3[$row->pool_id][$key].'%"  width="10px"/>';  
                            }
                            else if($value<100){
                               echo '<img style="float: left; padding:0 5px 10px 0px;cursor:pointer;" src="'.base_url().'admin_resources/images/colors_percent/90.png" 
                                        alt="Block: '.$details['sub_pool_values'].'/'.$details['subnet'].'</br>Usage: '.$temp3[$row->pool_id][$key].'%"  width="10px"/>';  
                            }
                            }?>
                        
                    </td>
                    

                </tr>
                <?php }?>

                </tbody>
                </table>
                    <div>
                        <img id="fullPic" style="float: left;cursor:pointer;" src="<?php echo base_url();?>admin_resources/images/colors_percent/percent.png" height="80px;" width="200px;" onclick="readImage()"/>
                    </div>
                </form>
            </div>

            <div class="clear"></div>
      </div>

    </div> <!-- End .content-box-content -->

</div>


<script type="text/javascript">
    $('#4').addClass('current');
</script>
</html>



