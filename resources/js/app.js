require("./bootstrap");

import Alpine from "alpinejs";
import * as THREE from "three";
import { gsap, Power2, Back } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { GLTFLoader } from "three/examples/jsm/loaders/GLTFLoader.js";
import { RGBELoader } from "three/examples/jsm/loaders/RGBELoader.js";
import { Loader } from "@googlemaps/js-api-loader";

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;

let isSmallScreen = false;
if(window.screen.width < 768){
    isSmallScreen = true;
}
window.addEventListener('resize', (event) => {
    if(window.screen.width < 768){
        isSmallScreen = true;
    }

    // RESET SLIDER
    [...document.querySelectorAll(".imageCarouselItem")].forEach((item, index) => {
        console.log(parseInt(window.getComputedStyle(item, null).getPropertyValue('padding-left')));
        item.style.width = item.dataset.originalWidth = `${
            [...document.querySelectorAll(".imageCarouselImages")][index].getBoundingClientRect().width + parseInt(window.getComputedStyle(item, null).getPropertyValue('padding-left')) + parseInt(window.getComputedStyle(item, null).getPropertyValue('padding-right'))
        }px`;
    });

    calculateDimensions();
    document.body.style.height = `${sliderWidth}px`;

    
});

document.addEventListener("alpine:init", () => {
    Alpine.data("artwork", () => ({
        hoveredArtwork: "",
        artworkel: document.getElementById("artworkTitle"),
        selectedCategory: [],
        categoriesOpen: false,
        sliderCovers: [...document.querySelectorAll(".sliderCover")],
        artworkTitleAnimation: {},
        scrollTime: -1,
        isScrolling: false,
        openDetail: false,
        detailTimeline: null,
        artworkTitle: "",
        artworkDescription: "",
        artworkCategories: [],
        artworkDetailId: 0,

        toggleCategory(category) {
            this.categoriesOpen = false;
            const items = [...document.querySelectorAll(".imageCarouselItem")];

            if (this.selectedCategory.includes(category)) {
                this.sliderCovers.forEach((item) => {
                    item.style.left = "0%";
                });
                if (this.selectedCategory.length === 1) {
                    cateogireAnimation(() => {
                        items.forEach((item) => {
                            item.style.width = item.dataset.originalWidth;
                            item.classList.add("px-8");
                        });
                    });
                } else {
                    cateogireAnimation(() => {
                        items.forEach((item) => {
                            if (item.classList.contains(category)) {
                                item.style.width = 0;
                                item.classList.remove("px-8");
                            }
                        });
                    });
                }

                this.selectedCategory.splice(
                    this.selectedCategory.indexOf(category),
                    1
                );
            } else {
                this.sliderCovers.forEach((item) => {
                    item.style.left = "0%";
                });
                if (!this.selectedCategory.length) {
                    cateogireAnimation(() => {
                        items.forEach((item) => {
                            item.style.width = 0;
                            item.classList.remove("px-8");
                            if (item.classList.contains(category)) {
                                item.style.width = item.dataset.originalWidth;
                                item.classList.add("px-8");
                            }
                        });
                    });
                } else {
                    cateogireAnimation(() => {
                        items.forEach((item) => {
                            if (item.classList.contains(category)) {
                                item.style.width = item.dataset.originalWidth;
                                item.classList.add("px-8");
                            }
                        });
                    });
                }

                this.selectedCategory.push(category);
            }
        },
        scrollArtworks() {
            if (this.isScrolling == false) {
                this.isScrolling = true;
                gsap.to("#progressbarBorder", {
                    scaleY: 1,
                    duration: 0.2,
                });
                gsap.to("#progressbarLine", {
                    scaleX: 1,
                    duration: 0.2,
                });
                gsap.to("#progressbarTip", {
                    scale: 1,
                    duration: 0.2,
                });
            }

            //while we are scrolling, restart the timer
            if (this.scrollTimer != -1) {
                clearTimeout(this.scrollTimer);
            }

            //if the timer isnt cleared, we run the function to
            //display the element(s) again
            this.scrollTimer = window.setTimeout(() => {
                gsap.to("#progressbarBorder", {
                    scaleY: 0,
                    duration: 0.2,
                });
                gsap.to("#progressbarLine", {
                    scaleX: 0,
                    duration: 0.2,
                });
                gsap.to("#progressbarTip", {
                    scale: 0,
                    duration: 0.2,
                });
                this.isScrolling = false;
            }, 1000);
        },

        imageClicked(artwork) {
            if (this.openDetail) {

                if (this.detailTimeline) {
                    this.detailTimeline.kill();
                }
                let imageRect = document.getElementById("artworkImage-" +  this.artworkDetailId).getBoundingClientRect()

                this.detailTimeline = gsap
                    .timeline()
                    .fromTo(
                        ".slideUp",
                        {
                            opacity: 1,
                            translateY: 0,
                        },
                        {
                            opacity: 0,
                            translateY: 30,
                            duration: 0.3,
                            ease: Power2.easeInOut,
                        }
                    )
                    .to("#artworkImage-" + this.artworkDetailId + "-clone", {
                        top: `calc(${imageRect.top}px - 4.5rem)`,
                        left: imageRect.left,
                        width: imageRect.width,
                        padding: 0,
                        duration: 0.3,
                        ease: Power2.easeOut,
                    },
                    ">-=0.2")
                    .fromTo(
                        "#artworkDetailBG",
                        {
                            opacity: 1,
                        },
                        {
                            opacity: 0,
                            duration: 0.3,
                            ease: Power2.easeInOut,
                            onComplete: () =>{
                                this.openDetail = false;
                            }
                        },
                        ">-=0.3"
                    
                    );
            } else {
                this.openDetail = true;
                this.artworkDetailId = artwork;
                document
                    .getElementById("artworkDetail")
                    .classList.remove("hidden");

                // Copy image and delete previous
                let imagewrapper = document.getElementById(
                    "artworkDetailImageWrapper"
                );
                imagewrapper.innerHTML = "";

                let image = document.getElementById("artworkImage-" + artwork);
                let imageRect = image.getBoundingClientRect();

                // change title description and categories
                this.artworkTitle = image.dataset.artworkTitle;
                this.artworkDescription = image.dataset.artworkDescription;
                this.artworkCategories =
                    image.dataset.artworkCategories.split("-");

                let clone = document
                    .getElementById("artworkImage-" + artwork)
                    .cloneNode();
                clone.removeAttribute("class");
                clone.classList.add("absolute", "p-12");
                clone.id = "artworkImage-" + artwork + "-clone";

                clone.style.width = imageRect.width + "px";
                clone.style.height = "auto";
                clone.style.left = imageRect.left + "px";
                clone.style.top = imageRect.top + "px";

                imagewrapper.appendChild(clone);

                let imageSetWidth = !isSmallScreen ? "66%" : "100%" ;

                this.detailTimeline = gsap
                    .timeline()
                    .to("#artworkImage-" + artwork + "-clone", {
                        top: 0,
                        left: 0,
                        height: '100%',
                        duration: 0.4,
                        ease: Power2.easeOut,
                    })
                    .fromTo(
                        "#artworkDetailBG",
                        {
                            opacity: 0,
                        },
                        {
                            opacity: 1,
                            duration: 0.3,
                            ease: Power2.easeInOut,
                        },
                        ">-=0.5"
                    )
                    .fromTo(
                        ".slideUp",
                        {
                            opacity: 0,
                            translateY: 30,
                        },
                        {
                            opacity: 1,
                            translateY: 0,
                            duration: 0.3,
                            stagger: 0.1,
                            ease: Power2.easeInOut,
                        }
                    );
            }
        },

        changeArtworkTitle(artwork) {
            // Wrap every letter in a span
            var textWrapper = document.getElementById(
                "artworkTitle-" + artwork
            );

            if (this.artworkTitleAnimation[artwork]) {
                this.artworkTitleAnimation[artwork].kill();
                this.artworkTitleAnimation[artwork] = null;
            }

            this.artworkTitleAnimation[String(artwork)] = gsap
                .timeline()
                .fromTo(
                    "#artworkTitle-" + artwork + "  .letter",
                    {
                        translateY: 20,
                        opacity: 0,
                    },
                    {
                        translateY: 0,
                        opacity: 1,
                        duration: 0.2,
                        ease: Power2.easeOut,
                        stagger: 0.05,
                    },
                );
        },
        removeArtworkTitle(artwork) {
            // Wrap every letter in a span
            var textWrapper = document.getElementById(
                "artworkTitle-" + artwork
            );

            if (this.artworkTitleAnimation[artwork]) {
                this.artworkTitleAnimation[artwork].kill();
            }

            this.artworkTitleAnimation[artwork].reverse();
        },
        moveArtworkTitle(artwork) {
            var textWrapper = document.getElementById(
                "artworkTitle-" + artwork + "-wrapper"
            );
            var image = document.getElementById("artworkImage-" + artwork);

            // Get the bounding rectangle of target
            const rect = event.target.getBoundingClientRect();

            // Mouse position
            const x = event.clientX - rect.left;
            const percX = (x / rect.width) * 100 - 50;

            gsap.to("#artworkTitle-" + artwork + "-wrapper", {
                duration: 0.4,
                transform: `translateX(${-50 + percX}%)`,
            });
        },
    }));
});
Alpine.start();

// CATEGORIES

let categoryTimeline;
let cateogireAnimation = function (callback) {
    if (categoryTimeline) {
        categoryTimeline.pause();
    }
    categoryTimeline = gsap
        .timeline()
        .to(".imageCarouselItem", {
            duration: 0.7,
            marginTop: "-100vh",
            ease: Back.easeIn,
            delay: "random(0, 0.2)",
            onComplete: () => {
                callback();
                calculateDimensions();
            },
        })
        .to(".imageCarouselItem", {
            opacity: 0,
            marginTop: "100vh",
            duration: 0.0001,
        })
        .to(".imageCarouselItem", {
            duration: 1,
            marginTop: "0",
            opacity: 1,
            ease: Back.easeOut,
            delay: "random(0, 0.2)",
        });
};

// CAROUSEL

let clones = [];
let scrollPos;
let clonesWidth;
let sliderWidth;
let progressbarTip;
let sliderWrap;
let slider;
let items;
let images;

function getClonesWidth() {
    let width = 0;
    clones.forEach((clone) => {
        width += clone.offsetWidth;
    });
    return width;
}
function getScrollPosition() {
    return window.scrollY;
}

function scrollUpdate() {
    scrollPos = getScrollPosition();
    if (clonesWidth + scrollPos >= sliderWidth) {
        window.scrollTo({ top: 1 });
    } else if (scrollPos <= 0) {
        window.scrollTo({ top: sliderWidth - clonesWidth - 1 });
    }

    slider.style.transform = `translateX(${-window.scrollY}px)`;
    
    progressbarTip.style.left = `${
        (window.scrollY / (sliderWidth / 2)) * 100
    }%`;

    requestAnimationFrame(scrollUpdate);
}

function onload() {
    progressbarTip = document.getElementById("progressbarTip");
    sliderWrap = document.getElementById("slider_wrap");
    slider = document.getElementById("slider");
    items = [...document.querySelectorAll(".imageCarouselItem")];
    images = [...document.querySelectorAll(".imageCarouselImages")];

    items.forEach((item) => {
        let clone = item.cloneNode(true);
        clone.classList.add("clone");
        slider.appendChild(clone);
        clones.push(clone);
    });
    [...document.querySelectorAll(".imageCarouselItem")].forEach((item) => {
        item.style.width = item.dataset.originalWidth = `${
            item.getBoundingClientRect().width
        }px`;
    });

    calculateDimensions();
    document.body.style.height = `${sliderWidth}px`;

    window.scrollTo({ top: 1 });
    scrollUpdate();
}

function calculateDimensions(width) {
    sliderWidth = slider.getBoundingClientRect().width;

    clonesWidth = getClonesWidth();
}

window.addEventListener("load", (event) => {});
Promise.all(
    Array.from(document.images)
        .filter((img) => !img.complete)
        .map(
            (img) =>
                new Promise((resolve) => {
                    img.onload = img.onerror = resolve;
                })
        )
).then(() => {
    onload();
});

// MOUSE ACTION

// get all links
let mouseIsMovable = true;
let mouseIsHoveringBtn = false;
let allHoverLinks = document.querySelectorAll("[data-hover]");
// let allHoverDivs = document.querySelectorAll("div[data-hover-btn]");
// let allHoverButton = document.querySelectorAll("a[data-hover-btn]");

// allHoverDivs.forEach((btn) => {
//     btn.addEventListener("mouseenter", (e) => {
//         gsap.to("#mouse", {
//             duration: 0.1,
//             css: {
//                 backgroundColor: "#f6eee3",
//             },
//         });
//     });
//     btn.addEventListener("mouseout", (e) => {
//         gsap.to("#mouse", {
//             duration: 0.1,
//             css: {
//                 backgroundColor: "#063e33",
//             },
//         });
//     });
// });

allHoverLinks.forEach((link) => {
    link.addEventListener("mouseenter", (e) => {
        gsap.to("#mouse", {
            duration: 0.1,
            css: {
                width: "0.5rem",
                height: "0.5rem",
            },
        });
    });
    link.addEventListener("mouseout", (e) => {
        gsap.to("#mouse", {
            duration: 0.1,
            css: {
                width: "1rem",
                height: "1rem",
            },
        });
    });
});

function moveMouse(e) {
    gsap.to("#mouse", {
        duration: 0.1,
        css: {
            left: e.pageX,
            top: e.pageY - window.scrollY,
            transform: "translate(-50%,-50%)",
        },
    });
}

window.addEventListener("mousemove", moveMouse);

// HIDE MouSE IF MOBILE

if (
    /iPhone|Android/i.test(navigator.userAgent) ||
    /(ipad|tablet|(android(?!.*mobile))|(windows(?!.*phone)(.*touch))|kindle|playbook|silk|(puffin(?!.*(IP|AP|WP))))/.test(
        navigator.userAgent.toLowerCase()
    )
) {
    document.getElementById("mouse").hidden = true;
}

function convertRemToPixels(rem) {    
    return rem * parseFloat(getComputedStyle(document.documentElement).fontSize);
}
