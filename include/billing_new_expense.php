<form method="post" name="postform" action="">
  <div class="box box-primary">
    <div class="box-body">
      <div class="form-group col-md-2">
        <input type="text" name="location" class="form-control" placeholder="Location/Place" required />
        <input type="hidden" name="travel_id_old" class="form-control" value="<?php echo $retv['travel_id'];?>"  />
      </div>
      <div class="form-group col-md-2">
        <input type="date" name="date_expense" class="form-control" placeholder="Date" required />
      </div>
      <div class="form-group col-md-2">
        <select name="type" class="form-control" placeholder="Type" required>
          <option value=" ">--- SELECT ---</option>
          <option value="Entertainment">Entertainment</option>
          <option value="Hotel">Hotel</option>
          <option value="Meal">Meal</option>
          <option value="Misc.">Misc.</option>
          <option value="Transport">Transport</option>
        </select>
      </div>
      <div class="form-group col-md-2">
        <input type="text" name="amount" class="form-control" placeholder="Amount" required />
      </div>
      <div class="form-group col-md-2">
        <input type="text" name="remark" class="form-control" placeholder="Remark" required />
      </div>
      <div class="form-group col-md-2">
        <input type="text" name="submit_date" class="form-control" value="<?php echo date('Y-m-d');?>" readonly />
      </div>
      <div class="box-body">
        <button class="btn btn-block btn-default" value="Enter" name="submit">Save</button>
      </div>
    </div>
  </div>
</form>