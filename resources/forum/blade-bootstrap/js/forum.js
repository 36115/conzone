import 'bootstrap/dist/css/bootstrap.min.css';
import feather from 'feather-icons';
import { createApp, ref, reactive, watch } from 'vue/dist/vue.esm-bundler.js';
import axios from 'axios';
import draggable from 'vuedraggable/src/vuedraggable';

window.axios = axios;
window.Vue = { createApp, ref, reactive, watch };
window.VueDraggable = draggable;

document.addEventListener('DOMContentLoaded', function () {
    createApp({
        setup() {
            const isCollapsed = ref(true);
            const isUserDropdownCollapsed = ref(true);

            window.addEventListener('click', event => {
                const ignore = ['navbar-toggler', 'navbar-toggler-icon', 'dropdown-toggle'];
                if (ignore.some(className => event.target.classList.contains(className))) return;
                if (!isCollapsed.value) isCollapsed.value = true;
                if (!isUserDropdownCollapsed.value) isUserDropdownCollapsed.value = true;
            });

            return {
                isCollapsed,
                isUserDropdownCollapsed,
            };
        }
    }).mount('.v-navbar');

    const mask = document.querySelector('.mask');

    function findModal (key)
    {
        const modal = document.querySelector(`[data-modal=${key}]`);

        if (!modal) throw `Attempted to open modal '${key}' but no such modal found.`;

        return modal;
    }

    function openModal (modal)
    {
        modal.style.display = 'block';
        mask.style.display = 'block';
        setTimeout(function()
        {
            modal.classList.add('show');
            mask.classList.add('show');
        }, 200);
    }

    document.querySelectorAll('[data-open-modal]').forEach(item =>
    {
        item.addEventListener('click', event =>
        {
            event.preventDefault();

            openModal(findModal(event.currentTarget.dataset.openModal));
        });
    });

    document.querySelectorAll('[data-modal]').forEach(modal =>
    {
        modal.addEventListener('click', event =>
        {
            if (!event.target.hasAttribute('data-close-modal')) return;

            modal.classList.remove('show');
            mask.classList.remove('show');
            setTimeout(function()
            {
                modal.style.display = 'none';
                mask.style.display = 'none';
            }, 200);
        });
    });

    document.querySelectorAll('[data-dismiss]').forEach(item =>
    {
        item.addEventListener('click', event => event.currentTarget.parentElement.style.display = 'none');
    });

    const hash = window.location.hash.substr(1);
    if (hash.startsWith('modal='))
    {
        openModal(findModal(hash.replace('modal=','')));
    }

    feather.replace();

    if (!input) return;
});
