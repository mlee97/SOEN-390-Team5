@component('mail::message')
Hello {{$user->first_name}} {{$user->last_name}},
<br/>

There has been a disruption on the manufacturing floor with **Job # {{$job->id}}**.
<br/>
<br/>
<br/>
# Job Detail

@component('mail::table')
| Job ID | Assignee | Bicycle Type | Quantity | Date Created |
| ------------- | ------------- | ------------ | ------------- | ------------- |
| {{$job->id}} | {!!($job->user_id)==null ? html_entity_decode("<p class=text-muted><em>NONE</em></p>"): $jobAssignee !!} | {{$bikeType}} | {{$job->quantity}} | {{$job->created_at}} |
@endcomponent
<hr>
<sub>You are receiving this email because you are registered as a Product Manager in the ERP System</sub>
@endcomponent
