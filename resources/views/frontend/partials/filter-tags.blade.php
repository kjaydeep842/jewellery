{{--
Filter Active Tags Bar
──────────────────────
Renders pill tags for every checked filter checkbox.
Each tag has an × that unchecks that specific input and calls
window.updateProducts() (global on all filter pages).

Usage: @include('frontend.partials.filter-tags')
Must appear INSIDE the products grid wrapper, below the sort bar.
--}}
<div id="active-filter-tags-wrap" class="mb-4 hidden">
    <div id="active-filter-tags" class="flex flex-wrap gap-2 items-center"></div>
</div>

<script>
    (function () {
        function buildTags() {
            var wrap = document.getElementById('active-filter-tags-wrap');
            var container = document.getElementById('active-filter-tags');
            if (!wrap || !container) return;

            var form = document.getElementById('filterForm');
            if (!form) return;

            var checked = form.querySelectorAll('input[type="checkbox"]:checked');
            container.innerHTML = '';

            if (checked.length === 0) {
                wrap.classList.add('hidden');
                return;
            }

            wrap.classList.remove('hidden');

            checked.forEach(function (input) {
                var label = document.createElement('span');
                label.className =
                    'inline-flex items-center gap-1.5 pl-3 pr-2 py-1.5 rounded-full border border-[#D4B896] bg-white text-sm font-[\'Outfit\'] text-[#5C4522] whitespace-nowrap';

                var text = document.createTextNode(input.value);
                label.appendChild(text);

                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className =
                    'ml-1 w-4 h-4 flex items-center justify-center rounded-full bg-[#EFE4D6] hover:bg-[#5C4522] hover:text-white text-[#5C4522] transition-colors flex-shrink-0';
                btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" fill="currentColor" class="w-2.5 h-2.5"><path d="M6.414 5L9.207 2.207a1 1 0 00-1.414-1.414L5 3.586 2.207.793A1 1 0 00.793 2.207L3.586 5 .793 7.793a1 1 0 001.414 1.414L5 6.414l2.793 2.793a1 1 0 001.414-1.414L6.414 5z"/></svg>';

                btn.addEventListener('click', function () {
                    input.checked = false;
                    buildTags();
                    if (typeof window.updateProducts === 'function') {
                        window.updateProducts();
                    }
                });

                label.appendChild(btn);
                container.appendChild(label);
            });
        }

        // Build on load (after form is rendered)
        document.addEventListener('DOMContentLoaded', function () {
            buildTags();

            var form = document.getElementById('filterForm');
            if (form) {
                form.addEventListener('change', function (e) {
                    if (e.target.type === 'checkbox') {
                        buildTags();
                    }
                });
            }
        });

        // Re-build after AJAX product updates (called externally)
        window.rebuildFilterTags = buildTags;

        // Patch window.toggleClearButton (called by jQuery-based pages) to also rebuild tags.
        // We retry after 600ms because jQuery pages define this inside $(document).ready().
        function patchToggleClear() {
            if (window.toggleClearButton && !window.toggleClearButton.__ft_patched) {
                var orig = window.toggleClearButton;
                window.toggleClearButton = function () {
                    orig.apply(this, arguments);
                    buildTags();
                };
                window.toggleClearButton.__ft_patched = true;
            }
        }
        patchToggleClear();
        setTimeout(patchToggleClear, 600);
    })();
</script>