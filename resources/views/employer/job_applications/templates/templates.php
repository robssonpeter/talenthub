<script id="jobApplicationActionTemplate" type="text/x-jsrender">
 <div class="dropdown d-inline mr-2">
      <button class="btn btn-primary dropdown-toggle" type="button" id="actionDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
      <div class="dropdown-menu mb-3">
        {{if !isCompleted}}
            {{if !isShortlisted}}
                <a class="dropdown-item short-list" href="#" data-id="{{:id}}"><?php echo __('messages.common.shortlist') ?></a>
            {{/if}}
            {{if isShortlisted}}
                {{if !interviewed}}
                    <a class="dropdown-item action-interviewed" href="#" data-id="{{:id}}"><?php echo __('messages.common.interviewed') ?></a>
                {{/if}}
                <a class="dropdown-item action-completed" href="#" data-id="{{:id}}"><?php echo __('messages.common.selected') ?></a>
            {{/if}}
            <a class="dropdown-item action-decline" href="#" data-id="{{:id}}"><?php echo __('messages.common.rejected') ?></a>
        {{/if}}

        {{if !notes.length}}
            <a class="dropdown-item action-note border-top" data-toggle="modal" data-target="#add-note" href="#" data-id="{{:id}}"><?php echo __('messages.common.add_note') ?></a>
        {{else}}
            <a class="dropdown-item action-notes border-top" data-toggle="modal" data-target="#show-notes" href="#" data-id="{{:id}}"><?php echo __('messages.common.view_notes') ?></a>
        {{/if}}
        {{if !interviewScheduled && isShortlisted}}
             <a class="dropdown-item action-interview-schedule" href="#" data-id="{{:id}}"><?php echo __('messages.apply_job.schedule_interview') ?></a>
        {{else}}
            {{if !interviewed}}
             <a class="dropdown-item action-interview-schedule" href="#" data-id="{{:id}}"><?php echo __('messages.apply_job.reschedule_interview') ?></a>
            {{/if}}
        {{/if}}
        <a class="dropdown-item action-delete" href="#" data-id="{{:id}}"><?php echo __('messages.common.delete') ?></a>
    </div>
 </div>
</script>
<script></script>
