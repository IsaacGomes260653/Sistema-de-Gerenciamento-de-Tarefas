(function () {
    'use strict';

    /* Theme toggle — persisted per-browser; head script already applied the initial value. */
    function initTheme() {
        var toggles = document.querySelectorAll('[data-theme-toggle]');
        var root = document.documentElement;

        function apply(theme) {
            root.setAttribute('data-theme', theme);
            try { localStorage.setItem('sgt-theme', theme); } catch (e) { /* private mode: ignore */ }
            toggles.forEach(function (btn) {
                btn.setAttribute('aria-pressed', theme === 'dark');
            });
        }

        toggles.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var current = root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
                apply(current === 'dark' ? 'light' : 'dark');
            });
        });
    }

    /* User avatar dropdown */
    function initUserMenu() {
        var trigger = document.querySelector('[data-user-trigger]');
        var menu = document.querySelector('[data-user-dropdown]');
        if (!trigger || !menu) return;

        function close() {
            menu.removeAttribute('data-open');
            trigger.setAttribute('aria-expanded', 'false');
        }

        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            var open = menu.hasAttribute('data-open');
            if (open) { close(); } else {
                menu.setAttribute('data-open', '');
                trigger.setAttribute('aria-expanded', 'true');
            }
        });

        document.addEventListener('click', function (e) {
            if (!menu.contains(e.target)) close();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') close();
        });
    }

    /* Toasts: auto-dismiss + manual close, announced politely for screen readers */
    function dismissToast(toast) {
        if (!toast || toast.hasAttribute('data-leaving')) return;
        toast.setAttribute('data-leaving', '');
        toast.addEventListener('animationend', function () { toast.remove(); }, { once: true });
    }

    function initToasts() {
        document.querySelectorAll('.toast').forEach(function (toast) {
            var timer = setTimeout(function () { dismissToast(toast); }, 4500);
            var closeBtn = toast.querySelector('.toast-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    clearTimeout(timer);
                    dismissToast(toast);
                });
            }
        });
    }

    /* Password show/hide toggle */
    function initPasswordToggle() {
        document.querySelectorAll('[data-password-toggle]').forEach(function (btn) {
            var input = document.getElementById(btn.getAttribute('data-password-toggle'));
            if (!input) return;
            btn.addEventListener('click', function () {
                var isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                btn.innerHTML = isHidden ? window.SGT_ICONS.eyeSlash : window.SGT_ICONS.eye;
                btn.setAttribute('aria-label', isHidden ? 'Ocultar senha' : 'Mostrar senha');
            });
        });
    }

    /* Live character counter for the description textarea */
    function initCharCount() {
        document.querySelectorAll('[data-char-count]').forEach(function (field) {
            var target = document.getElementById(field.getAttribute('data-char-count'));
            var max = Number(field.getAttribute('maxlength')) || 0;
            if (!target) return;
            function update() {
                target.textContent = field.value.length + ' / ' + max;
            }
            field.addEventListener('input', update);
            update();
        });
    }

    /* Custom confirm dialog for destructive actions — replaces window.confirm() so it never blocks the tab */
    function initConfirmForms() {
        var backdrop = document.querySelector('[data-confirm-dialog]');
        if (!backdrop) return;

        var titleEl = backdrop.querySelector('[data-confirm-title]');
        var bodyEl = backdrop.querySelector('[data-confirm-body]');
        var confirmBtn = backdrop.querySelector('[data-confirm-accept]');
        var cancelBtns = backdrop.querySelectorAll('[data-confirm-cancel]');
        var pendingForm = null;
        var lastFocused = null;

        function open(form) {
            pendingForm = form;
            titleEl.textContent = form.getAttribute('data-confirm-title') || 'Confirmar ação';
            bodyEl.textContent = form.getAttribute('data-confirm-body') || 'Essa ação não pode ser desfeita.';
            lastFocused = document.activeElement;
            backdrop.setAttribute('data-open', '');
            confirmBtn.focus();
        }

        function close() {
            backdrop.removeAttribute('data-open');
            pendingForm = null;
            if (lastFocused) lastFocused.focus();
        }

        document.querySelectorAll('[data-confirm-submit]').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                if (form.dataset.confirmed === 'true') return;
                e.preventDefault();
                open(form);
            });
        });

        confirmBtn.addEventListener('click', function () {
            if (pendingForm) {
                pendingForm.dataset.confirmed = 'true';
                pendingForm.requestSubmit();
            }
            close();
        });

        cancelBtns.forEach(function (btn) { btn.addEventListener('click', close); });
        backdrop.addEventListener('click', function (e) { if (e.target === backdrop) close(); });
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && backdrop.hasAttribute('data-open')) close(); });
    }

    /* Disable submit buttons on submit to prevent double-clicks / double POSTs */
    function initSubmitLock() {
        document.querySelectorAll('form[data-lock-submit]').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                // A confirm-guarded form fires submit twice: once intercepted (preventDefault,
                // waits on the dialog) and once for real after the user confirms. Only lock the
                // real one, or the button would show "Salvando…" while the dialog is still open.
                if (e.defaultPrevented) return;
                var btn = form.querySelector('button[type="submit"]');
                if (btn) {
                    btn.disabled = true;
                    btn.dataset.originalHtml = btn.innerHTML;
                    btn.innerHTML = window.SGT_ICONS.spinner + '<span>Salvando…</span>';
                }
            });
        });
    }

    /* Client-side search + status filter for the task list — the full set is already rendered
       server-side, so narrowing it here is instant and needs no round-trip. */
    function initTaskFilter() {
        var input = document.querySelector('[data-task-filter]');
        var statusBtns = document.querySelectorAll('[data-status-filter]');
        if (!input && statusBtns.length === 0) return;

        var rows = document.querySelectorAll('[data-task-row]');
        var emptyState = document.querySelector('[data-filter-empty]');
        var activeStatus = 'all';

        function apply() {
            var term = input ? input.value.trim().toLowerCase() : '';
            var visible = 0;
            rows.forEach(function (row) {
                var haystack = row.getAttribute('data-search') || '';
                var status = row.getAttribute('data-status') || '';
                var matchesText = haystack.indexOf(term) !== -1;
                var matchesStatus = activeStatus === 'all' || status === activeStatus;
                var match = matchesText && matchesStatus;
                row.style.display = match ? '' : 'none';
                if (match) visible += 1;
            });
            if (emptyState) emptyState.hidden = visible !== 0;
        }

        if (input) input.addEventListener('input', apply);

        statusBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                statusBtns.forEach(function (b) { b.setAttribute('aria-pressed', 'false'); });
                btn.setAttribute('aria-pressed', 'true');
                activeStatus = btn.getAttribute('data-status-filter');
                apply();
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        initTheme();
        initUserMenu();
        initToasts();
        initPasswordToggle();
        initCharCount();
        initConfirmForms();
        initSubmitLock();
        initTaskFilter();
    });
})();
