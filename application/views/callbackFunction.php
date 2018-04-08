<?php echo validation_errors(); ?>
<form method="POST" action="">
    <input type="hidden" value="<?php echo $trip_id=!empty($data->trip_id)? $data->trip_id : 0   ;?>" name="trip_id">
    <input type="text" name="data[kidpool_trip_id]" value="<?php echo $kidpool_trip_id=!empty($data->kidpool_trip_id)?$data->kidpool_trip_id:set_value('data[kidpool_trip_id]');?>">
    <input type="text" name="data[trip_name]" value="<?php echo $trip_name=!empty($data->trip_name)?$data->trip_name     :set_value('data[trip_name]');?>" >
    <input type="submit">

</form>