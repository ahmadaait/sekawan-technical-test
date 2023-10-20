<script>
	import { session } from '$app/stores';

	const auth = $session.auth;
</script>

<table cellspacing="0" cellpadding="0" class="table-sm table-information">
	<colgroup>
		<col style="width:150px"><col style="width:10px"><col>
	</colgroup>
	<tbody>
		<tr> <td>Nama User</td> <td>:</td> <td>{auth.user_name}</td> </tr>
		<tr> <td>Email</td> <td>:</td> <td>{auth.user_email}</td> </tr>
		<tr> <td>Tanggal Join</td> <td>:</td> <td>2021-01-24 04:42:51</td> </tr>
		<tr> <td>Terakhir Login</td> <td>:</td> <td>2021-07-24 04:42:51</td> </tr>
	</tbody>
</table>
