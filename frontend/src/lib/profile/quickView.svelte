<script>
	import { localStorageGet } from '$lib/app/localStorage';
	const session = localStorageGet('auth');
	//get profile from profile endpoint
	let innerWidth;
</script>

<svelte:window bind:innerWidth />

<div class="user-profile mb-3">
	{#if session}
		<div class="imgSrc">
			<div class="circlebox-{innerWidth >= 768 ? 1 : 2}">
				<div>
					<!-- <img
						src={$session.auth.user_imgSrc}
						alt="User"
						onerror="this.src='/img/user-male.png'"
						class="w-100"
					/> -->
				</div>
			</div>
		</div>
		<div class="info-{innerWidth >= 768 ? 1 : 2}">
			<div class="">{'Suyatno'}</div>
			<div class="">{'suyatno@mail.com'}</div>
		</div>
	{:else}
		<div class="imgSrc">
			<div class="circlebox-{innerWidth >= 768 ? 1 : 2}">
				<div>
					<img src="/img/user-male.png" alt="User" class="w-100" />
				</div>
			</div>
		</div>
		<div class="info-{innerWidth >= 768 ? 1 : 2}">
			<div class="mb-1">Silahkan Login atau register.</div>
			<div>
				<button class="btn bgcolor-pri account-login">Login</button>
				<a href="/account/register" class="btn bgcolor-ter">Register</a>
			</div>
		</div>
	{/if}
</div>
