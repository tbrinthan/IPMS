<div id="ippooldetails" class="content-box" > <!-- Messages are shown when a link with these attributes are clicked: href="#messages" rel="modal"  -->
    <div class="content-box-content">
        <div class="content-box-header">
            <h3>Details of Location : [ <?php echo $location['location'];?> ] </h3>
        </div>
        <div class="clear">
            <p></p>
        </div>

        <table class="sample" width="500Px" border="1Px"  >

            <thead style="font-variant: small-caps ;    ">
            <tr>
                <th style="text-align: center"> ID</th>
                <th>SSID</th>
           </tr>

            </thead>
            <span></span>
            <tbody>
            <?php

            foreach($ssid_location_details as $rowmain){?>
            <tr >
                <td style="text-align: center"><?php echo $rowmain->sub_category_id;?></td>
                <td><?php echo $rowmain->ssid;?></td>

            </tr>
                <?php }?>


            </tbody>



        </table>




    </div> <!-- End #messages -->
</div>