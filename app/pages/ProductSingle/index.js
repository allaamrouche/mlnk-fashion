import Page from '../../classes/Page';  
import gsap from 'gsap';

export default class ProductSingle extends Page {
    constructor() {
        super({
            id: 'product-single',
            element: '.product-single',
            elements: {
                wrapper: '.product-single__wrapper',
                navigation: '.navigation',
                tabs: '.woocommerce-tabs ul.tabs li',
                tabPanels: '.woocommerce-Tabs-panel', 
                mainImage: '.element__reveal__img.product-single--image-media',
                thumbnails: '.product-single--thumbnails .woocommerce-product-gallery__image',
                attributeOptions: '.attribute-option'
            }
        });
    }


    create() {
        super.create();
        this.setupThumbnails();
        this.addThumbnailClickHandlers();
        this.addTabToggleHandlers(); 
        this.addAttributeOptionHandlers();
    }

    setupThumbnails() {
        const mainImageContainer = this.elements.mainImage[0];
        const mainImageUrl = mainImageContainer.style.backgroundImage;
        const thumbnailContainer = document.querySelector('.product-single--thumbnails');

        // Clear existing thumbnails
        while (thumbnailContainer.firstChild) {
            thumbnailContainer.removeChild(thumbnailContainer.firstChild);
        }

        // Add the main product image as a thumbnail only if additional thumbnails are provided
        if (this.elements.thumbnails.length > 0) {
            this.addThumbnail(mainImageUrl, thumbnailContainer); // Add main image as first thumbnail

            // Append all other provided thumbnails
            this.elements.thumbnails.forEach(thumbnail => {
                thumbnailContainer.appendChild(thumbnail);
            });
        }
    }

    addThumbnail(imageUrl, container) {
        console.log('imageUrl', imageUrl);  // Debug to see what imageUrl is actually received
        
        // Create the outermost container for the thumbnail
        const thumbnail = document.createElement('div');
        thumbnail.className = 'element__reveal product-single--thumbnails woocommerce-product-gallery__image';
        thumbnail.setAttribute('data-animation', 'reveal');
    
        // Create the inner container that will directly contain the image
        const innerDiv = document.createElement('div');
        innerDiv.className = 'element__reveal__inner';
    
        // Create the innermost div that will actually contain the background image
        const imgDiv = document.createElement('div');
        imgDiv.className = 'element__reveal__img product-single--thumbnails-image';
        
        // Since imageUrl is already in the correct format, assign it directly
        imgDiv.style.backgroundImage = imageUrl;
    
        // Assemble the thumbnail structure
        innerDiv.appendChild(imgDiv);
        thumbnail.appendChild(innerDiv);
        container.appendChild(thumbnail);
    }
    
    
   
    

    // addThumbnail(imageUrl, container) {
    //     const thumbnail = document.createElement('div');
    //     thumbnail.className = 'woocommerce-product-gallery__image';
    //     const imgDiv = document.createElement('div');
    //     imgDiv.className = 'product-single--thumbnails-image';
    //     imgDiv.style.backgroundImage = imageUrl;
    //     imgDiv.style.backgroundSize = 'cover'; // Ensure image fits well within the thumbnail
    //     thumbnail.appendChild(imgDiv);
    //     container.appendChild(thumbnail);
    // }

    addThumbnailClickHandlers() {
        const allThumbnails = document.querySelectorAll('.product-single--thumbnails .woocommerce-product-gallery__image');
        allThumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', (event) => {
                const imgDiv = thumbnail.querySelector('.product-single--thumbnails-image');
                if (imgDiv) {
                    const newImageUrl = imgDiv.style.backgroundImage;
                    const mainImageContainer = this.elements.mainImage[0];
                    if (newImageUrl && mainImageContainer) {
                        gsap.set(mainImageContainer, {
                            backgroundImage: newImageUrl,
                            backgroundSize: '70%'
                        });
                        gsap.to(mainImageContainer, {
                            duration: 1,
                            ease: 'power2.out',
                            backgroundSize: '100%',
                            opacity: 1,
                            onStart: function() {
                                gsap.set(mainImageContainer, {opacity: 0});
                            }
                        });
                    } else {
                        console.error('Error: New image URL is undefined, or main image element not found.');
                    }
                } else {
                    console.error('Error: Thumbnail image div not found.');
                }
            });
        });
    }

    addTabToggleHandlers() {
        this.elements.tabs.forEach(tab => {
            const targetPanel = document.getElementById(tab.getAttribute('aria-controls'));
            tab.addEventListener('click', (e) => {
                e.preventDefault(); 
    
                // Ensure all panels are closed initially, except the target panel
                this.elements.tabPanels.forEach(panel => {
                    if (panel !== targetPanel) {
                        gsap.to(panel, {duration: 0.5, display: 'none', opacity: 0});
                    }
                });
    
                // Toggle the target panel
                if (targetPanel) {
                    if (targetPanel.style.display === 'none' || targetPanel.style.display === '') {
                        gsap.to(targetPanel, {duration: 0.5, display: 'block', opacity: 1});
                    } else {
                        gsap.to(targetPanel, {duration: 0.5, display: 'none', opacity: 0});
                    }
                }
            });
        });
    }

    addAttributeOptionHandlers() {
        const attributeOptions = this.elements.attributeOptions;
        if (attributeOptions) {
            attributeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Get corresponding select element
                    const selectId = this.parentNode.id.replace('div_', '');
                    const selectElement = document.getElementById(selectId);

                    // Update select value
                    if (selectElement) {
                        selectElement.value = this.dataset.value;
                        selectElement.dispatchEvent(new Event('change'));  // Trigger change to update WooCommerce

                        // Manage selected visuals for buttons
                        this.parentNode.querySelectorAll('.attribute-option').forEach(opt => {
                            opt.classList.remove('selected');
                            opt.style.textDecoration = 'none';
                        });

                        this.classList.add('selected');
                        this.style.textDecoration = 'underline';
                    }
                });
            });
        }
    }

    

    show() {
        return new Promise(resolve => {
            super.show().then(() => {
                this.removeActiveClasses();
                resolve();
            });
        });
    }

    removeActiveClasses() {
        if (this.elements.tabs && this.elements.tabPanels) {
            this.elements.tabs.forEach(tab => tab.classList.remove('active'));
            this.elements.tabPanels.forEach(panel => panel.style.display = 'none');
        }
    }

    destroy() {
        super.destroy();
        if (this.elements.thumbnails) {
            this.elements.thumbnails.forEach(thumbnail => {
                thumbnail.removeEventListener('click', this.handleThumbnailClick);
            });
        }
    }
}

