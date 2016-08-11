 <div class="row">
   <div class="col-md-10 col-md-offset-1">
    <h3 class="page-header">Car Inventory</h3>
     <div class="panel panel-default">
       <!-- Default panel contents -->
       <!-- Table -->
       <table class="table">
         <thead>
           <tr>
             <th>Sr no</th>
             <th>Car Name</th>
             <th>Manufacturer Name</th>
             <th>Count</th>
           </tr>
         </thead>
         <tbody>
           <?php  
            foreach ($result as $key => $value) {
              echo "<tr data-ids=".$value["ids"].">";
                echo "<td>".$key."</td>";
                echo "<td>".$value['car_name']."</td>";
                echo "<td>".$value['manufacturer_name']."</td>";
                echo "<td>".$value['count']."</td>";
              echo "</tr>";
            }
           ?>
         </tbody>
       </table>
     </div>
   </div>
 </div>


 <div class="modal fade" id="car_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Cars in the list</h4>
        </div>
        <div class="modal-body" id="modal_body">
          data is loading hang on ...
         <!--  <div>
            <div class="row">
              <div class="col-md-1 col-md-offset-1">
                <p><strong> Name: </strong></p>
              </div>
              <div class="col-md-1">
                <p> Something</p>
              </div>
              
              <div class="col-md-1 col-md-offset-1">
                <p><strong> Color: </strong></p>
              </div>
              <div class="col-md-1">
                <p> Something</p>
              </div>

              <div class="col-md-1 col-md-offset-1">
                <p><strong> Year: </strong></p>
              </div>
              <div class="col-md-1">
                <p> 2014 </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-1 col-md-offset-1">
                <p><strong>Reg-no</strong></p>
              </div>
              <div class="col-md-1">
                <p>
                  12345
                </p>
              </div>
              <div class="col-md-1 col-md-offset-1 ">
                <p><strong>Note:</strong></p>
              </div>
              <div class="col-md-5">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
              </div>
            </div>
            <div class="row">
               
              <div class="col-md-5 col-md-offset-1">
                <div class="car-img-container">
                  <img src="assets/img/14708796101.jpg" class="img-thumbnail"/>
                </div>
              </div>

              <div class="col-md-5 col-md-offset-1  ">
                <div class="car-img-container">
                  <img src="assets/img/14708796101.jpg" class="img-thumbnail"/>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-2 col-md-offset-5">
                <button class="btn btn-primary btn-lg">Sold Out</button>
              </div>
            </div>
          </div>
          <hr> -->


           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
     </div>
   </div>
 </div>