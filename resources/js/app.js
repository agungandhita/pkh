import './bootstrap';

const sidebar = document.getElementById('app-sidebar');
const overlay = document.getElementById('app-sidebar-overlay');

const openSidebar = () => {
    if (!sidebar || !overlay) return;
    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
};

const closeSidebar = () => {
    if (!sidebar || !overlay) return;
    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
};

document.querySelectorAll('[data-sidebar-open]').forEach((el) => {
    el.addEventListener('click', openSidebar);
});

document.querySelectorAll('[data-sidebar-close]').forEach((el) => {
    el.addEventListener('click', closeSidebar);
});

window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeSidebar();
});
