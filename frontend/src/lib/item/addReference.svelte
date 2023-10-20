<script>
	import { goto } from '$app/navigation';
	import { xfetch } from '$lib/app/request';
	import { page } from '$app/stores';

	let gender,
		ageRange,
		ageMin,
		ageMax,
		dateType = [],
		normalValueRange,
		markForReport,
		criticalValue;

	let validAgeRangeFormat = 'none',
		validDateYearRequired = 'none';

	let year = false,
		month = false,
		day = false,
		hour = false;

	function onChange(event) {
		gender = event.currentTarget.value;
	}

	const id = $page.url.searchParams.get('id');

	async function save() {
		let isValid = true;

		if (year) dateType.push('year');
		if (month) dateType.push('month');
		if (day) dateType.push('day');
		if (hour) dateType.push('hour');

		if (!year && !month && !day && !hour) {
			validDateYearRequired = 'block';
			isValid = false;
		} else {
			validDateYearRequired = 'none';
		}

		if (ageRange.includes('~')) {
			[ageMin, ageMax] = ageRange.split('~');
			validAgeRangeFormat = 'none';
		} else {
			validAgeRangeFormat = 'block';
			isValid = false;
		}

		if (!isValid) return;

		let refResponse = await xfetch(`itemreference`, 'post', {
			ItemId: Number(id),
			gender,
			ageMin: Number(ageMin),
			ageMax: Number(ageMax),
			dateType,
			normalValueRange,
			markForReport,
			criticalValue
		});
		console.log('ref resp:', refResponse);
		if (refResponse.status == 200) {
			location.href = '/lis-area/item/detail?id=' + id;
		}
	}

	$: console.log($page);
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		<div class="col-md-6 mb-3">
			<label for="gender" class="visible-ie8 visible-ie9 mb-1">Jenis Kelamin</label>

			<div class="input-icon">
				<input bind:group={gender} type="radio" name="gender" value="male" required /> Laki-laki
				&nbsp; &nbsp;
				<input bind:group={gender} type="radio" name="gender" value="female" required /> Perempuan
			</div>
		</div>

		<div class="col-md-6 mb-3" />

		<div class="col-md-6 mb-3">
			<label for="ageRange" class="visible-ie8 visible-ie9 mb-1">Rentang Usia</label>

			<div class="input-icon">
				<i class="bi bi-person" />
				<input
					name="ageRange"
					type="text"
					bind:value={ageRange}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					placeholder="Contoh: 1 ~ 12"
					required
				/>
				<div style="display: {validAgeRangeFormat};" class="invalid-feedback">
					Format tidak valid
				</div>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="dateType" class="visible-ie8 visible-ie9 mb-1">Tipe Waktu</label>

			<div class="input-icon">
				<input type="checkbox" bind:checked={year} />
				Year &nbsp;
				<input type="checkbox" bind:checked={month} />
				Month &nbsp;
				<input type="checkbox" bind:checked={day} />
				Day &nbsp;
				<input type="checkbox" bind:checked={hour} />
				Hour
			</div>

			<div style="display: {validDateYearRequired};" class="invalid-feedback">
				Wajib isi salah satu
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="normalValueRange" class="visible-ie8 visible-ie9 mb-1">Rentang Nilai Normal</label
			>

			<div class="input-icon">
				<i class="bi bi-clipboard" />
				<input
					name="normalValueRange"
					type="text"
					bind:value={normalValueRange}
					on:input={() => (markForReport = normalValueRange)}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					placeholder="Contoh: 0.1 ~ 1"
					required
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="markForReport" class="visible-ie8 visible-ie9 mb-1">Teks Default</label>

			<div class="input-icon">
				<i class="bi bi-clipboard-x" />
				<input
					name="markForReport"
					type="text"
					bind:value={markForReport}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					placeholder="Contoh: 0.1 ~ 1"
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="criticalValue" class="visible-ie8 visible-ie9 mb-1">Nilai Kritis</label>

			<div class="input-icon">
				<i class="bi bi-bullseye" />
				<input
					name="criticalValue"
					type="text"
					bind:value={criticalValue}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					placeholder="Contoh: 0.1 ~ 1"
				/>
			</div>
		</div>

		<hr />
		<div class="col-md-6 mb-3">
			<button
				type="button"
				on:click={() => (location.href = '/lis-area/item/detail?id=' + id)}
				class="btn btn-secondary"><i class="bi bi-backspace" /> Kembali</button
			>

			<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
		</div>
	</div>
</form>
