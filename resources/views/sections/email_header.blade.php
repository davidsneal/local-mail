<span class="mail-header-subject">{{ $header->subject }}</span>
<table>
	<tr>
		<th>Date</th>
		<td>{{ $header->date }}</td>
	</tr>
	<tr>
		<th>From</th>
		<td>{{ $header->fromaddress }}</td>
	</tr>
	<tr>
		<th>To</th>
		<td>{{ $header->toaddress }}</td>
	</tr>
</table>