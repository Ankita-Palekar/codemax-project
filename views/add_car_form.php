<div class="row">
  <div class="col-md-10">
    <h3 class="page-header">Add Car Model</h3>
    <form enctype="multipart/form-data" method="post" class="form-horizontal" id="add_car_form">
      <div class="message-info">
        
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-4">
          <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-4">
          <select class="form-control" name="manufacturer_id" id="manufacturer_id">
            <?php 
              foreach ($result as $value) { 
                echo "<option value='".$value['id']."'>".$value['name']."</option>";
              }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Color</label>
        <div class="col-sm-4">
          <input type="text" name="color" id="color" class="form-control" required>
        </div>

        <label class="col-sm-2 control-label">Manufacturing Date</label>
        <div class="col-sm-4">
          <input type="number" name="manufacturing_year" id="manufacturing_year" class="form-control" required>
        </div>        
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Reg No</label>
        <div class="col-sm-4">
          <input type="text" name="reg_no" id="reg_no" class="form-control" required>
        </div>

        <label class="col-sm-2 control-label">Note</label>
        <div class="col-sm-4">
          <textarea class="form-control" row="4" name="note" id="note">
            
          </textarea>
        </div>        
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Picture 1</label>
        <div class="col-sm-4">
          <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
            <div>
              <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="files[]" required=""></span>
              <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
            </div>
          </div>
        </div>
        <label class="col-sm-2 control-label">Picture 2</label>
        <div class="col-sm-4">
          <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
            <div>
              <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="files[]" required></span>
              <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="form-group">
        <div class="col-sm-6 col-sm-offset-5">
          <input type="submit" class="btn btn-primary" value="submit" name="submit">
        </div>
      </div>
    </form>
  </div>
</div>