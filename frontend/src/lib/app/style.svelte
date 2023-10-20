<style>
	/******************* STANDARD ******************(/
	/* reset */
	:global(body) {
		/* font-size:0.9rem !important; */
		font-family: 'Quicksand', Arial, Helvetica, sans-serif;
	}
	:global(a) {
		color: #212529;
		text-decoration: none;
	}
	:global(input::-webkit-outer-spin-button),
	:global(input::-webkit-inner-spin-button) {
		-webkit-appearance: none;
		margin: 0;
	}
	:global(input[type='number']) {
		-moz-appearance: textfield;
	}
	:global(.h6),
	:global(h6) {
		font-size: 1.1rem;
	}
	:global(.h1),
	:global(.h2),
	:global(.h3),
	:global(.h4),
	:global(.h5),
	:global(.h6),
	:global(h1),
	:global(h2),
	:global(h3),
	:global(h4),
	:global(h5),
	:global(h6) {
		font-weight: 600;
	}

	/******************* BOOTSTRAP ******************(/
	/* bs input, btn */
	:global(.form-control),
	:global(.input-group-text),
	:global(.btn) {
		font-size: inherit !important;
		border-radius: 4px;
	}

	/* dropdown */
	:global(.dropdown-menu) {
		font-size: inherit;
		border: unset;
		border-radius: unset;
	}
	:global(.dropdown-item:active) {
		background-color: #f3dea7;
	}
	:global(.dropdown-menu-end) {
		right: 0px;
	}

	/******************* THEME ******************(/
	/* common */
	:global(.nowrap) {
		white-space: nowrap;
	}
	:global(.pointer) {
		cursor: pointer;
	}
	:global(.fw-600) {
		font-weight: 600;
	}

	/* theme shadow */
	:global(.xshadow-0) {
		box-shadow: none !important;
	}
	:global(.xshadow-1) {
		box-shadow: 0 0 0.3rem rgba(0, 0, 0, 0.15) !important;
	}
	:global(.xshadow-2) {
		box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.25) !important;
	}

	@media (min-width: 768px) {
		:global(.xshadow-md-1) {
			box-shadow: 0 0 0.3rem rgba(0, 0, 0, 0.15) !important;
		}
		:global(.xshadow-md-2) {
			box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.25) !important;
		}
	}
	@media (min-width: 992px) {
		:global(.xshadow-lg-1) {
			box-shadow: 0 0 0.3rem rgba(0, 0, 0, 0.15) !important;
		}
		:global(.xshadow-lg-2) {
			box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.25) !important;
		}
	}
	@media (min-width: 1200px) {
		:global(.xshadow-xl-1) {
			box-shadow: 0 0 0.3rem rgba(0, 0, 0, 0.15) !important;
		}
		:global(.xshadow-xl-2) {
			box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.25) !important;
		}
	}
	@media (min-width: 1400px) {
		:global(.xshadow-xxl-1) {
			box-shadow: 0 0 0.3rem rgba(0, 0, 0, 0.15) !important;
		}
		:global(.xshadow-xxl-2) {
			box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.25) !important;
		}
	}

	/* theme bg color */
	:global(.bgcolor-pri) {
		background-color: #823782 !important;
		color: #fff !important;
	}
	:global(.bgcolor-pri a),
	:global(.bgcolor-pri h6) {
		color: #fff !important;
	}
	:global(.bgcolor-sec) {
		background-color: #828648 !important;
		color: #fff !important;
	}
	:global(.bgcolor-sec a),
	:global(.bgcolor-sec h6) {
		color: #fff !important;
	}
	:global(.bgcolor-ter) {
		background-color: #834736 !important;
		color: #fff !important;
	}
	:global(.bgcolor-ter a),
	:global(.bgcolor-ter h6) {
		color: #fff !important;
	}

	/* theme mainnavbar */
	:global(.mainnavbar) {
		height: 54px;
	}
	:global(.mainnavbar .dropdown-toggle::after) {
		display: none;
		margin-left: 0.255em;
	}
	:global(.mainnavbar .dropdown-menu a) {
		color: #444 !important;
	}
	:global(.mainnavbar .dropdown-menu a.btn) {
		color: #fff !important;
	}
	:global(.mainnavbar .navbar-nav > .nav-item > .nav-link) {
		color: #fff;
		padding-left: 0.4rem;
		padding-right: 0.4rem;
		cursor: pointer;
	}
	@media (min-width: 768px) {
		:global(.mainnavbar .navbar-nav > .nav-item > .nav-link) {
			padding-left: 0.6rem;
			padding-right: 0.6rem;
		}
	}

	/* theme slider */
	:global(.slider) {
		width: 100%;
		position: fixed;
		top: 0px;
		left: -105%;
		height: 100vh;
		background-color: #fff;
		transition: all 0.3s;
		z-index: 9999;
	}
	:global(.slider.show) {
		left: 0;
	}

	/* theme circle */
	:global(.circlebox-1) {
		width: 3rem;
		height: 3rem;
		border: 1px solid #4f6680;
		border-radius: 50%;
		font-size: 1.75rem;
		text-align: center;
		line-height: 2rem;
		overflow: hidden;
	}
	:global(.circlebox-2) {
		width: 4.5rem;
		height: 4.5rem;
		border: 2px solid #4f6680;
		border-radius: 50%;
		font-size: 3rem;
		text-align: center;
		line-height: 3.5rem;
		overflow: hidden;
	}
	:global(.circlebox-3) {
		width: 6rem;
		height: 6rem;
		border: 2px solid #4f6680;
		border-radius: 50%;
		font-size: 4rem;
		text-align: center;
		line-height: 4rem;
		overflow: hidden;
	}
	:global(.circlebox-3 > img) {
		width: 100%;
		height: 100%;
	}

	/* theme input lg size */
	:global(input[type='checkbox'].lg),
	:global(input[type='radio'].lg) {
		width: 18px;
		height: 18px;
	}

	/* theme input icon */
	:global(.input-icon) {
		position: relative;
	}
	:global(.input-icon .form-control) {
		padding-left: 36px;
	}
	:global(.input-icon > i) {
		position: absolute;
		top: 6px;
		left: 10px;
		text-align: center;
		font-size: 1rem;
		width: 16px;
	}
	:global(.input-icon > i),
	:global(.radio-list > label) {
		display: block;
	}

	/* theme border */
	:global(.border-right) {
		border-right: 1px solid #dee2e6 !important;
	}

	/* btn hover swipe */
	:global(.hvr-sweep-to-top) {
		display: inline-block;
		vertical-align: middle;
		-webkit-transform: translateZ(0);
		transform: translateZ(0);
		box-shadow: 0 0 1px rgba(0, 0, 0, 0);
		-webkit-backface-visibility: hidden;
		backface-visibility: hidden;
		-moz-osx-font-smoothing: grayscale;
		position: relative;
		-webkit-transition-property: color;
		transition-property: color;
		-webkit-transition-duration: 0.2s;
		transition-duration: 0.2s;
	}
	:global(.hvr-sweep-to-top:before) {
		content: '';
		position: absolute;
		z-index: -1;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: #2098d1;
		-webkit-transform: scaleY(0);
		transform: scaleY(0);
		-webkit-transform-origin: 50% 100%;
		transform-origin: 50% 100%;
		-webkit-transition-property: transform;
		transition-property: transform;
		-webkit-transition-duration: 0.1s;
		transition-duration: 0.1s;
		-webkit-transition-timing-function: ease-out;
		transition-timing-function: ease-out;
	}
	:global(.hvr-sweep-to-top:hover),
	:global(.hvr-sweep-to-top:focus),
	:global(.hvr-sweep-to-top:active) {
		color: white;
	}
	:global(.hvr-sweep-to-top:hover:before),
	:global(.hvr-sweep-to-top:focus:before),
	:global(.hvr-sweep-to-top:active:before) {
		-webkit-transform: scaleY(1);
		transform: scaleY(1);
	}
	:global(.hvr-sweep-to-top.blue-400:before) {
		background: #29b6f6;
	}
	:global(.hvr-sweep-to-top.orange-400:before) {
		background: #ffa726;
	}

	/* theme list */
	:global(.listcontent) {
		padding-right: 65px;
	}
	:global(.listnavspacer) {
		width: 50px;
		position: absolute;
		right: 0px;
		top: 1rem;
	}
	:global(.listnavspacer .navbtn) {
		border-radius: 50%;
		width: 34px;
		height: 34px;
		padding: 0px;
	}
	:global(.listnavspacer .dropdown-toggle.navbtn::after) {
		display: none;
	}

	/* theme user profile */
	:global(.user-profile) {
		min-height: 80px;
		position: relative;
	}
	:global(.user-profile .imgSrc) {
		position: absolute;
		top: 10px;
		left: 15px;
	}
	:global(.user-profile .info-1) {
		padding-left: 80px;
		padding-right: 15px;
	}
	:global(.user-profile .info-2) {
		padding-left: 110px;
		padding-right: 15px;
		padding-top: 10px;
	}

	/******************* THEME & BS ******************(/

	/* theme bs card breakpoints*/
	:global(.card),
	:global(.card-sm),
	:global(.card-md),
	:global(.card-lg),
	:global(.card-xl),
	:global(.card-xxl) {
		position: relative;
		display: -ms-flexbox;
		display: flex;
		-ms-flex-direction: column;
		flex-direction: column;
		min-width: 0;
		word-wrap: break-word;
		background-color: #fff;
		background-clip: border-box;
		border-radius: 0px !important;
	}

	@media (min-width: 576px) {
		:global(.card-sm) {
			border: 1px solid rgba(0, 0, 0, 0.125);
			border-radius: 0.25rem;
		}
	}

	@media (min-width: 768px) {
		:global(.card-md) {
			border: 1px solid rgba(0, 0, 0, 0.125);
			border-radius: 0.25rem;
		}
	}

	@media (min-width: 992px) {
		:global(.card-lg) {
			border: 1px solid rgba(0, 0, 0, 0.125);
			border-radius: 0.25rem;
		}
	}

	@media (min-width: 1200px) {
		:global(.card-xl) {
			border: 1px solid rgba(0, 0, 0, 0.125);
			border-radius: 0.25rem;
		}
	}

	@media (min-width: 1400px) {
		:global(.card-xxl) {
			border: 1px solid rgba(0, 0, 0, 0.125);
			border-radius: 0.25rem;
		}
	}

	/* theme bs border breakdown */
	@media (min-width: 768px) {
		:global(.border-top-md) {
			border-top: 1px solid rgba(0, 0, 0, 0.125);
		}
	}

	/* theme bs dropdown */
	:global(.navbar-nav .nav-item i) {
		font-size: 1rem;
	}
	:global(.iconize .dropdown-item) {
		padding-top: 6px;
		padding-bottom: 6px;
		padding-left: 40px;
		position: relative;
	}
	:global(.iconize a .icon) {
		position: absolute;
		font-size: 1rem;
		top: 6px;
		left: 12px;
	}

	/* theme bs button */
	:global(.btn-rounded) {
		width: 30px;
		height: 30px;
		border-radius: 50%;
		line-height: 22px;
		padding: 0px;
		font-size: 0.6rem;
	}

	/******************* TNS PLUGIN ******************(/
	/* tns */
	:global(.tns-carousel) {
		position: relative;
	}
	:global(.tns-carousel .tns-outer),
	:global(.product-list) {
		margin-left: -0.5em;
		margin-right: -0.5em;
	}
	:global(.tns-gallery .tns-inner) {
		border-top-right-radius: 12px;
		border-top-left-radius: 12px;
		border-bottom-right-radius: 12px;
		border-bottom-left-radius: 12px;
		overflow: hidden;
	}

	:global(.tns-gallery .tns-navs) {
		position: absolute;
		bottom: 10px;
		text-align: center;
		width: 100%;
	}
	:global(.tns-gallery .tns-navs button) {
		height: 16px;
		width: 16px;
		margin-left: 4px;
		margin-right: 4px;
		border: none;
		border-radius: 50%;
		background-color: rgba(255, 255, 255, 0.5);
		border: 2px solid rgba(0, 0, 0, 0.1);
	}
	:global(.tns-gallery .tns-navs button.tns-nav-active) {
		width: 40px;
		border-top-right-radius: 8px;
		border-top-left-radius: 8px;
		border-bottom-right-radius: 8px;
		border-bottom-left-radius: 8px;
	}

	:global(.tns-gallery .tns-controls),
	:global(.tns-carousel .tns-controls) {
		position: absolute;
		top: 40%;
		width: 100%;
	}
	:global(.tns-gallery .tns-controls button),
	:global(.tns-carousel .tns-controls button) {
		background-color: rgba(0, 0, 0, 0.25);
		color: rgba(255, 255, 255, 0.85);
		width: 40px;
		height: 40px;
		border-radius: 50%;
		border: 3px solid rgba(255, 255, 255, 0.5);
		font-weight: bold;
	}
	:global(.tns-gallery .tns-controls button:nth-of-type(1)),
	:global(.tns-carousel .tns-controls button:nth-of-type(1)) {
		margin-left: 10px;
	}
	:global(.tns-gallery .tns-controls button:nth-of-type(2)),
	:global(.tns-carousel .tns-controls button:nth-of-type(2)) {
		position: absolute;
		right: 10px;
	}

	@media (min-width: 1200px) {
		:global(.tns-gallery .tns-item) {
			max-height: 320px;
			overflow-y: hidden;
		}

		:global(.tns-gallery .tns-item img) {
			margin-top: -50px;
		}

		:global(.tns-gallery .tns-controls) {
			top: 40%;
		}
	}
	@media (min-width: 1400px) {
		:global(.tns-gallery .tns-item) {
			max-height: 350px;
			overflow-y: hidden;
		}

		:global(.tns-gallery .tns-item img) {
			margin-top: -60px;
		}
		:global(.tns-gallery .tns-controls) {
			top: 45%;
		}
	}
</style>
