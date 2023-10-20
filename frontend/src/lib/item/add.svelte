<script>
	import { goto } from '$app/navigation';
	import { xfetch } from '$lib/app/request';
	import { page } from '$app/stores';

	let refId,
		code,
		levelType,
		levelCode1,
		levelCode2,
		levelCode3,
		nameID,
		nameEN,
		description,
		unit,
		mapCode,
		defaultValue;

	let disabled = $page.params.slug === 'detail' ? 'disabled' : '';

	const method = $page.params.slug === 'add' ? 'post' : 'put';
	const id = $page.url.searchParams.get('id');
	async function save() {
		//create/update test type
		if ((categoryCode == null || categoryCode == '') && (subCode == null || subCode == '')) {
			levelType = 1;
			refId = null;
		}
		//create/update test group
		else if (subCode == null || subCode == '') {
			levelType = 2;
			levelCode1 = categoryCode;
			refId = categoryOptions.filter((c) => {
				return c.code == categoryCode;
			})[0].id;
		}
		//create/update test parameter
		else {
			levelType = 3;
			levelCode1 = categoryCode;
			levelCode2 = subCode;
			refId = subOptions.filter((s) => {
				return s.code == subCode;
			})[0].id;
		}

		let itemResponse = await xfetch(`item/${id ? id : ''}`, method, {
			refId,
			levelType,
			levelCode1,
			levelCode2,
			nameID,
			nameEN,
			description,
			unit,
			mapCode
		});
		if (itemResponse.status == 201) {
			goto('/lis-area/item');
		}
	}

	$: console.log($page);

	export let item;
	if (item) {
		refId = item.refId;
		code = item.code;
		levelType = item.levelType;
		levelCode1 = item.levelCode1;
		levelCode2 = item.levelCode2;
		levelCode3 = item.levelCode3;
		nameID = item.nameID;
		nameEN = item.nameEN;
		description = item.description;
		unit = item.unit;
		mapCode = item.mapCode;
		defaultValue = item.defaultValue;
	}

	let categoryOptions = [];
	let categoryCode = '';
	async function getCategories() {
		const categories = await xfetch(`item?filtered=[{"id":"levelType","value":"1"}]`, 'get');
		categoryOptions = categories.data.map((c) => {
			return {
				nameID: c.nameID,
				code: c.code,
				id: c.id
			};
		});

		//get now category
		const category =
			levelCode1 == null
				? null
				: categories.data.filter((c) => {
						return c.levelCode1 == levelCode1;
				  });
		categoryCode = category ? category.code : '';

		if (levelType == 1) categoryCode = '';
	}

	let subOptions = [];
	let subCode = '';
	async function getSub(levelCode1) {
		const subs = await xfetch(
			`item?filtered=[{"id":"levelType","value":"2"},{"id":"levelCode1","value":"${levelCode1}"}]`,
			'get'
		);

		subOptions = subs.data.map((s) => {
			return {
				nameID: s.nameID,
				code: s.code,
				id: s.id
			};
		});

		//get now sub
		const sub =
			levelCode2 == null
				? null
				: subs.data.filter((c) => {
						return c.levelCode2 == levelCode2;
				  });
		subCode = sub ? sub.code : '';

		if (levelType == 2) subCode = '';
	}

	let references = xfetch(`item/${id}/reference`);

	async function deleteReference(refId) {
		const response = await xfetch(`itemreference/${refId}`, 'delete');
		if (response.status == 200) {
			location.reload();
		}
	}
</script>

<form on:submit|preventDefault={save}>
	<div class="row">
		{#if $page.params.slug === 'detail' || $page.params.slug === 'edit'}
			<div class="col-md-6 mb-3">
				<label for="code" class="visible-ie8 visible-ie9 mb-1">ID</label>
				<div class="input-icon">
					<i class="bi bi-card-heading" />
					<input
						name="code"
						type="text"
						bind:value={code}
						class="form-control placeholder-no-fix"
						autocomplete="off"
						disabled
					/>
				</div>
			</div>
			<div class="col-md-6 mb-3" />
		{/if}

		{#await getCategories() then}
			<div class="col-md-6 mb-3">
				<label for="category" class="visible-ie9 visible-ie9 mb-1">Kategori</label>

				<div class="input-icon">
					<select
						class="form-select col-md-3"
						name="category"
						bind:value={categoryCode}
						aria-label="select category"
						on:change={getSub(categoryCode)}
						{disabled}
					>
						{#each categoryOptions as co}<option value={co.code}>{co.nameID}</option>{/each}</select
					>
				</div>
			</div>
		{/await}

		{#await getSub(levelCode1) then}
			<div class="col-md-6 mb-3">
				<label for="sub" class="visible-ie9 visible-ie9 mb-1">Sub</label>

				<div class="input-icon">
					<select
						class="form-select col-md-3"
						name="sub"
						bind:value={subCode}
						aria-label="select sub"
						{disabled}
					>
						{#each subOptions as so}<option value={so.code}>{so.nameID}</option>{/each}</select
					>
				</div>
			</div>
		{/await}

		<div class="col-md-6 mb-3">
			<label for="nameID" class="visible-ie8 visible-ie9 mb-1">Nama (ID)</label>
			<div class="input-icon">
				<i class="bi bi-box" />
				<input
					name="nameID"
					type="text"
					bind:value={nameID}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="nameEN" class="visible-ie8 visible-ie9 mb-1">Nama (EN)</label>
			<div class="input-icon">
				<i class="bi bi-box" />
				<input
					name="nameEN"
					type="text"
					bind:value={nameEN}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="unit" class="visible-ie8 visible-ie9 mb-1">Satuan</label>
			<div class="input-icon">
				<i class="bi bi-suit-club" />
				<input
					name="unit"
					type="text"
					bind:value={unit}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-6 mb-3">
			<label for="mapCode" class="visible-ie8 visible-ie9 mb-1">Kode Map</label>
			<div class="input-icon">
				<i class="bi bi-code" />
				<input
					name="mapCode"
					type="text"
					bind:value={mapCode}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		<div class="col-md-12 mb-3">
			<label for="description" class="visible-ie8 visible-ie9 mb-1">Deskripsi</label>
			<div class="input-icon">
				<i class="bi bi-list" />
				<input
					name="description"
					type="text"
					bind:value={description}
					class="form-control placeholder-no-fix"
					autocomplete="off"
					{disabled}
				/>
			</div>
		</div>

		{#if $page.params.slug === 'detail'}
			<hr />

			<div class="col-md-12 mb-6">
				<h5>List Referensi Item</h5>
				<div class="row">
					<div class="col-md-6">
						<button
							type="button"
							class="btn btn-primary btn-sm"
							on:click={() => (location.href = '/lis-area/item/addreference?id=' + id)}
							><i class="bi bi-plus-lg" /></button
						>
					</div>
				</div>
				<hr />
				<div class="table-responsive">
					<table class="table table-striped table-bordered tb-list">
						<thead class="table-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Jenis Kelamin</th>
								<th scope="col">Rentang Usia</th>
								<th scope="col">Rentang Nilai Normal</th>
								<th scope="col">Teks Default</th>
								<th scope="col">Nilai Kritis</th>
								<th scope="col">##</th>
							</tr>
						</thead>
						<tbody>
							{#await references}
								<div>Processing</div>
							{:then result}
								{#if result.data.length === 0}
									<tr class="text-center">
										<td colspan="7">Tidak ada item referensi</td>
									</tr>
								{/if}
								{#each result.data as ref, i}
									<tr>
										<th scope="row">{++i}</th>
										<td>{ref.gender}</td>
										<td>{ref.ageMin} {ref.dateType} - {ref.ageMax} {ref.dateType}</td>
										<td>{ref.normalValueRange}</td>
										<td>{ref.markForReport ? ref.markForReport : '-'}</td>
										<td>{ref.criticalValue ? ref.criticalValue : '-'}</td>
										<td>
											<button on:click={() => deleteReference(ref.id)} class="btn btn-danger btn-sm"
												><i class="bi bi-trash" /></button
											>
										</td>
									</tr>
								{/each}
							{/await}
						</tbody>
					</table>
				</div>
			</div>
		{/if}

		<hr />
		<div class="col-md-6 mb-3">
			<button type="button" on:click={() => goto('/lis-area/item')} class="btn btn-secondary"
				><i class="bi bi-backspace" /> Kembali</button
			>
			{#if $page.params.slug !== 'detail'}
				<button type="submit" class="btn btn-primary"><i class="bi bi-save" /> Simpan</button>
			{/if}
		</div>
	</div>
</form>
