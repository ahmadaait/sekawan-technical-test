export const userMenuItems = [
	{
		title: 'Menu Utama',
		items: [
			{ title: 'Dashboard', icon: 'bi bi-house', url: '/admin-area' },
			{ title: 'Analytics', icon: 'bi bi-list', url: '/admin-area/analytic' }
		]
	},
	{
		title: 'Master Data',
		items: [
			{ title: 'Driver', icon: 'bi bi-speedometer', url: '/admin-area/drivers' },
			{ title: 'Tambang', icon: 'bi bi-tag', url: '/admin-area/mines' },
			{ title: 'Perusahaan', icon: 'bi bi-file-earmark-text', url: '/admin-area/companies' },
			{ title: 'Kendaraan', icon: 'bi bi-truck', url: '/admin-area/vehicles' }
		]
	},
	{
		title: 'Pendaftaran Order',
		items: [{ title: 'Order', icon: 'bi bi-bell', url: '/admin-area/orders' }]
	},
	{
		title: 'Profile',
		items: [
			{ title: 'User Management', icon: 'bi bi-person', url: '/admin-area/users' },
			{ title: 'Logout', icon: 'bi bi-toggle-off', url: '/logout' }
		]
	}
];

export const headOfficeMenuItems = [
	{
		title: 'Menu Utama',
		items: [{ title: 'Dashboard', icon: 'bi bi-house', url: '/admin-area' }]
	},
	{
		title: 'Order Approval',
		items: [{ title: 'Order', icon: 'bi bi-bell', url: '/admin-area/orders' }]
	},
	{
		title: 'Profile',
		items: [{ title: 'Logout', icon: 'bi bi-toggle-off', url: '/logout' }]
	}
];

export const branchOfficeMenuItems = [
	{
		title: 'Menu Utama',
		items: [{ title: 'Dashboard', icon: 'bi bi-house', url: '/admin-area' }]
	},
	{
		title: 'Order Approval',
		items: [{ title: 'Order', icon: 'bi bi-bell', url: '/admin-area/orders' }]
	},
	{
		title: 'Profile',
		items: [{ title: 'Logout', icon: 'bi bi-toggle-off', url: '/logout' }]
	}
];
