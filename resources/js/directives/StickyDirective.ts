// StickyDirective.js
export default {
    mounted(el, binding) {
        const { value: options } = binding;
        // Set initial CSS styles
        el.style.position = "sticky";
        el.style.top = options.top || "0";

        // Get the sticky container element
        const containerSelector = options.container || "";
        const container = containerSelector
            ? document.querySelector(containerSelector)
            : null;

        // Handle scroll event
        const handleScroll = () => {
            const rect = el.getBoundingClientRect();
            const scrollY = window.scrollY || window.pageYOffset;

            if (container) {
                const containerRect = container.getBoundingClientRect();
                const containerBottom =
                    containerRect.top + containerRect.height;
                if (
                    scrollY > containerRect.top &&
                    scrollY + rect.height < containerBottom
                ) {
                    el.style.position = "sticky";
                    el.style.top = options.top || "0";
                } else if (scrollY < containerRect.top) {
                    el.style.position = "static";
                }
            } else {
                if (scrollY > rect.top) {
                    el.style.position = "fixed";
                    el.style.top = options.top || "0";
                } else {
                    el.style.position = "static";
                }
            }
        };

        // Listen for scroll event
        window.addEventListener("scroll", handleScroll);

        // Store the handleScroll function on the element for cleanup
        el._handleScroll = handleScroll;
    },

    unmounted(el) {
        // Clean up event listener
        window.removeEventListener("scroll", el._handleScroll);
    },
};
