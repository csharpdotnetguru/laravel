@foreach($domainList as $domain)
<tr>
    <td>{{$domain->id}}</td>
    <td>{{$domain->domain}}</td>
    <td>{{$domain->type}}</td>
    <td class="clickable" data-edit-link="{{URL::route('domain_list_edit',[$domain->id])}}" onclick="edit_old(this)">Edit</td>
</tr>
@endforeach