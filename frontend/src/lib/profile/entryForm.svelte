<script>
	export let item = {
		name: '',
		japanName: '',
		birthDate: '',
		gender: '',
		postalCode: '',
		prefecture_id: '',
		address1: '',
		address2: '',
		address3: '',
		occupation: '',
		phoneNumber: '',
		faxNUmber: '',
		whatsApp: '',
		line: '',
	};

</script>

<form id="myForm">
	<div class="row">
		<div id="name_box" class="col-md mb-3">
			Nama Alfabet
			<input type="text" name="name" id="name" value="{item.name}" class="form-control addressKeyUpCheck">
			<div class="text-danger input-message"></div>
		</div>
		<div id="japanName_box" class="col-md mb-3">
			Nama Huruf Jepang
			<input type="text" name="japanName" id="japanName" value="{item.japanName}" class="form-control addressKeyUpCheck">
			<div class="text-danger input-message"></div>
		</div>
	</div>
	<div class="row">
		<div id="birthDate_box" class="col-md mb-3">
			Tanggal Lahir
			<input type="text" name="birthDate" id="birthDate" value="{item.birthDate}" class="form-control dateTimePicker datetimepicker-input" x-format="YYYY/MM/DD" data-toggle="datetimepicker" data-target="#birthDate">
			<div class="text-danger input-message"></div>
		</div>
		<div id="gender_box" class="col-md mb-3">
			Jenis Kelamin
			<select id="gender" name="gender" class="form-control addressChangeCheck"><option value="">.. Pilih Jenis Kelamin..</option><option id="gender_optVal_1" value="1" selected="selected">Laki-laki</option><option id="gender_optVal_2" value="2">Perempuan</option></select>			<div class="text-danger input-message"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md mb-3">
			<div id="postalCode_box" class="mb-3">
				Kode Pos
				<input type="text" name="postalCode" id="postalCode" value="{item.postalCode}" class="form-control mb-1 addressKeyUpCheck">
				<div class="text-danger input-message"></div>
			</div>
			<div id="prefecture_id_box" class="mb-3">
				Prefektur
				<select id="prefecture_id" name="prefecture_id" class="form-control addressChangeCheck"><option value="">.. Pilih ..</option><option id="prefecture_id_optVal_1" value="1" selected="selected">Hokkaido</option><option id="prefecture_id_optVal_2" value="2">Aomori</option><option id="prefecture_id_optVal_3" value="3">Iwate</option><option id="prefecture_id_optVal_4" value="4">Miyagi</option><option id="prefecture_id_optVal_5" value="5">Akita</option><option id="prefecture_id_optVal_6" value="6">Yamagata</option><option id="prefecture_id_optVal_7" value="7">Fukushima</option><option id="prefecture_id_optVal_8" value="8">Ibaraki</option><option id="prefecture_id_optVal_9" value="9">Tochigi</option><option id="prefecture_id_optVal_10" value="10">Gunma</option><option id="prefecture_id_optVal_11" value="11">Saitama</option><option id="prefecture_id_optVal_12" value="12">Chiba</option><option id="prefecture_id_optVal_13" value="13">Tokyo</option><option id="prefecture_id_optVal_14" value="14">Kanagawa</option><option id="prefecture_id_optVal_15" value="15">Niigata</option><option id="prefecture_id_optVal_16" value="16">Toyama</option><option id="prefecture_id_optVal_17" value="17">Ishikawa</option><option id="prefecture_id_optVal_18" value="18">Fukui</option><option id="prefecture_id_optVal_19" value="19">Yamanashi</option><option id="prefecture_id_optVal_20" value="20">Nagano</option><option id="prefecture_id_optVal_21" value="21">Gifu</option><option id="prefecture_id_optVal_22" value="22">Shizuoka</option><option id="prefecture_id_optVal_23" value="23">Aichi</option><option id="prefecture_id_optVal_24" value="24">Mie</option><option id="prefecture_id_optVal_25" value="25">Shiga</option><option id="prefecture_id_optVal_26" value="26">Kyoto</option><option id="prefecture_id_optVal_27" value="27">Osaka</option><option id="prefecture_id_optVal_28" value="28">Hyōgo</option><option id="prefecture_id_optVal_29" value="29">Nara</option><option id="prefecture_id_optVal_30" value="30">Wakayama</option><option id="prefecture_id_optVal_31" value="31">Tottori</option><option id="prefecture_id_optVal_32" value="32">Shimane</option><option id="prefecture_id_optVal_33" value="33">Okayama</option><option id="prefecture_id_optVal_34" value="34">Hiroshima</option><option id="prefecture_id_optVal_35" value="35">Yamaguchi</option><option id="prefecture_id_optVal_36" value="36">Tokushima</option><option id="prefecture_id_optVal_37" value="37">Kagawa</option><option id="prefecture_id_optVal_38" value="38">Ehime</option><option id="prefecture_id_optVal_39" value="39">Kōchi</option><option id="prefecture_id_optVal_40" value="40">Fukuoka</option><option id="prefecture_id_optVal_41" value="41">Saga</option><option id="prefecture_id_optVal_42" value="42">Nagasaki</option><option id="prefecture_id_optVal_43" value="43">Kumamoto</option><option id="prefecture_id_optVal_44" value="44">Ōita</option><option id="prefecture_id_optVal_45" value="45">Miyazaki</option><option id="prefecture_id_optVal_46" value="46">Kagoshima</option><option id="prefecture_id_optVal_47" value="47">Okinawa</option></select>				<input type="hidden" id="xprefecture_id" value="1">
				<div class="text-danger input-message"></div>
			</div>
		</div>
		<div class="col-md mb-3">
			<div id="address1_box" class="mb-3">
				Alamat
				<input type="text" name="address1" id="address1" value="{item.address1}" class="form-control mb-1 addressKeyUpCheck">
				<input type="text" name="address2" id="address2" value="{item.address2}" class="form-control mb-1 addressKeyUpCheck">
				<input type="text" name="address3" id="address3" value="{item.address3}" class="form-control mb-1 addressKeyUpCheck">
				<div class="text-danger input-message"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div id="phone_box" class="col-md mb-3">
			Telp
			<input type="text" name="phone" value="{item.phone}" class="form-control mb-1">
			<div class="text-danger input-message"></div>
		</div>
		<div class="col-md mb-3">
			Fax
			<input type="text" name="fax" value="{item.fax}" class="form-control mb-1">
		</div>
	</div>
	<div class="row">
		<div class="col-md mb-3">
			Whatsapp
			<input type="text" name="whatsapp_id" value="{item.whatsapp_id}" class="form-control mb-1">
		</div>
		<div class="col-md mb-3">
			Line
			<input type="text" name="line_id" value="{item.line_id}" class="form-control mb-1">
		</div>
	</div>
	<div class="row">
		<div id="occupation_box" class="col-md-6">
			Pekerjaan
			<div class=""><input type="text" name="occupation" value="{item.occupation}" class="form-control"></div>
			<div class="text-danger input-message"></div>
		</div>
	</div>

	<div id="shippingaddress_box" class="form-group row" style="display:none">
		<div id="shippingaddress_updateDefault_box" class="col-sm-6">
			Jadikan alamat default Pengiriman<br>
			<div class="form-check">
				<input type="checkbox" name="shippingaddress_updateDefault" id="shippingaddress_updateDefault" class="form-check-input" checked="checked">
				<label class="form-check-label" for="shippingaddress_updateDefault">Ya</label>
			</div>
		</div>
		<div id="OldShippingAddres_save_box" class="col-sm-6" style="display:none;">
			Simpan alamat lama
			<span title="Memungkinkan alamat lama untuk dijasikan pilhan alamat tujuan pengiriman" style="cursor:pointer;">
				[?]
			</span>
			<div class="form-check">
				<input type="checkbox" name="oldShippingAddres_save" class="form-check-input" value="" checked="checked">
				<label class="form-check-label" for="OldShippingAddres_save">Ya</label>
			</div>
		</div>
	</div>
</form>