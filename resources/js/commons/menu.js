const admin = [
    {
        label: "Dashboard",
        route: "admin.dashboard",
        roles: ['SUPER_ADMIN', "REGISTERED"]
    },
    {
        label: "Quản lý bài viết",
        route: "admin.posts",
        roles: ['SUPER_ADMIN', 'POST_WRITER', 'POST_MANAGER']
    },
    {
        label: "Quản lý địa điểm",
        route: "admin.locations.provinces",
        roles: ['SUPER_ADMIN']
    },
    {
        label: "Hệ thống",
        route: "system.permission",
        roles: ['SUPER_ADMIN']
    },
]

export const adminMenu = (role) => {
    return admin.filter(({roles}) => roles.includes(role));
}
