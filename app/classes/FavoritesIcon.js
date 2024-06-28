import axios from 'axios';

export default class FavoritesIcon {
    constructor(iconElement) {
        this.icon = iconElement;
        this.productId = this.icon.dataset.productId;
        this.path = this.icon.querySelector('.favorites-icon-path');
        this.init();
    }

    init() {
        this.icon.addEventListener('click', (event) => this.toggleFavorite(event));
    }

    toggleFavorite(event) {
        event.preventDefault(); // Prevent default if it's inside an <a> or similar

        axios.post(MalankaSettings.ajaxUrl, new URLSearchParams({
            'action': 'toggle_favorite',
            'product_id': this.productId,
            'nonce': MalankaSettings.nonce
        }).toString(), {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => {
            const data = response.data;
            // Check response for success and use the existing WooCommerce notices wrapper for message display
            if (data.success) {
                this.updateFavoriteIcon(data.is_favorited);
                this.displayNotice('Favorite status changed.', 'success');
            } else {
                this.displayNotice(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error toggling favorite:', error);
            this.displayNotice('Error processing request.', 'error');
        });
    }

    updateFavoriteIcon(isFavorited) {
        const fill = isFavorited ? '#111' : 'none'; // Update color based on whether the product is favorited
        this.path.setAttribute('fill', fill);
    }

    displayNotice(message, type) {
        const noticeType = type === 'error' ? 'woocommerce-error' : 'woocommerce-message';
        const noticesWrapper = document.querySelector('.woocommerce-notices-wrapper');
        if (noticesWrapper) {
            noticesWrapper.innerHTML = `<div class="${noticeType}">${message}</div>`;
        } else {
            console.error('Notice wrapper not found on the page.');
        }
    }

    destroy() {
        this.icon.removeEventListener('click', (event) => this.toggleFavorite(event));
    }
}
