<script id="companyActionTemplate" type="text/x-jsrender">
   <a title="<?php echo __('messages.common.edit') ?>" class="btn btn-warning action-btn edit-btn" href="{{:url}}">
            <i class="fa fa-edit"></i>
   </a>
   <a title="<?php echo __('messages.common.delete') ?>" class="btn btn-danger action-btn delete-btn" data-id="{{:id}}" href="#">
            <i class="fa fa-trash"></i>
   </a>


</script>


<script id="reportedCompanyActionTemplate" type="text/x-jsrender">
<a title="<?php echo __('messages.job.notes') ?>" class="btn btn-primary action-btn view-note" data-id="{{:id}}" href="#">
            <i class="fas fa-eye"></i>
   </a>
   <a title="<?php echo __('messages.common.delete') ?>" class="btn btn-danger action-btn delete-btn" data-id="{{:id}}" href="#">
            <i class="fa fa-trash"></i>
   </a>





</script>


<script id="isFeatured" type="text/x-jsrender">
   <label class="custom-switch pl-0">
        <input type="checkbox" name="Is Featured" class="custom-switch-input isFeatured" data-id="{{:id}}" {{:checked}}>
        <span class="custom-switch-indicator"></span>
    </label>



</script>

<script id="isActive" type="text/x-jsrender">
   <label class="custom-switch pl-0">
        <input type="checkbox" name="Is Active" class="custom-switch-input isActive" data-id="{{:id}}" {{:checked}}>
        <span class="custom-switch-indicator"></span>
    </label>


</script>
