require("./bootstrap");

import Alpine from "alpinejs";
import * as THREE from "three";
import { gsap, Power2, Back, Elastic } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { GLTFLoader } from "three/examples/jsm/loaders/GLTFLoader.js";
import { RGBELoader } from "three/examples/jsm/loaders/RGBELoader.js";
import { Loader } from "@googlemaps/js-api-loader";

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;

let isSmallScreen = false;

window.addEventListener("resize", (event) => {
    if (window.innerWidth < 768 && !isSmallScreen) {
        // first time small screen
        isSmallScreen = true;
        toSmall();
    } else if (window.innerWidth >= 768 && isSmallScreen) {
        // first time big screen
        isSmallScreen = false;
        toBig();
    }
    documentHeight();

    if (isSmallScreen) {
    } else {
        // RESET SLIDER
        [...document.querySelectorAll(".imageCarouselItem")].forEach(
            (item, index) => {
                item.style.width = item.dataset.originalWidth = `${
                    [...document.querySelectorAll(".imageCarouselImages")][
                        index
                    ].getBoundingClientRect().width +
                    parseInt(
                        window
                            .getComputedStyle(item, null)
                            .getPropertyValue("padding-left")
                    ) +
                    parseInt(
                        window
                            .getComputedStyle(item, null)
                            .getPropertyValue("padding-right")
                    )
                }px`;
            }
        );

        calculateDimensions();
        document.body.style.height = `${sliderWidth}px`;
    }

    // reset artworkdetailimage
    let artworkImageClone = document.getElementById("artworkImage-clone");
    if (artworkImageClone) {
        let textwrapperRect = document
            .getElementById("artworkDetailTextWrapper")
            .getBoundingClientRect();
        artworkImageClone.style.top = `calc(${
            textwrapperRect.top + textwrapperRect.height
        }px - 4.5rem)`;
        artworkImageClone.style.height = `${
            artworkImageClone.getBoundingClientRect().width /
            artworkImageClone.dataset.imageRatio
        }px`;
    }
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
        progressbarTip: document.getElementById("progressbarTip"),
        slider: document.getElementById("slider"),
        sliderWidth: 0,
        openDetail: false,
        detailTimeline: null,
        artworkTitle: "This is a artwork title",
        artworkDescription: "this is a artwork description",
        artworkCategories: [
            "category 1",
            "category 1",
            "category 1",
            "category 1",
            "category 1",
            "category 1",
            "category 1",
            "category 1",
        ],
        artworkDetailId: 0,

        getSliderWidth() {
            let sliderwidth = 0;
            [...this.slider.children].forEach((item) => {
                sliderwidth += item.getBoundingClientRect().width;
            });
            return sliderwidth;
        },

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
                            
                            document.getElementById(`artworkImage-${item.id.split('-').pop()}`).style.padding = '1rem';
                            // item.classList.add("px-8");
                        });
                    });
                } else {
                    cateogireAnimation(() => {
                        items.forEach((item) => {
                            if (item.classList.contains(category)) {
                                item.style.width = 0;
                                document.getElementById(`artworkImage-${item.id.split('-').pop()}`).style.padding = 0;
                                // item.classList.remove("px-8");
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
                            document.getElementById(`artworkImage-${item.id.split('-').pop()}`).style.padding = 0;
                            // item.classList.remove("px-8");
                            console.log(item.childNodes[2])
                            if (item.classList.contains(category)) {
                                item.style.width = item.dataset.originalWidth;
                                document.getElementById(`artworkImage-${item.id.split('-').pop()}`).style.padding = '1rem';
                                // item.classList.add("px-8");
                            }
                        });
                    });
                } else {
                    cateogireAnimation(() => {
                        items.forEach((item) => {
                            if (item.classList.contains(category)) {
                                item.style.width = item.dataset.originalWidth;
                                document.getElementById(`artworkImage-${item.id.split('-').pop()}`).style.padding = '1rem';
                                // item.classList.add("px-8");
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
            if (isSmallScreen) {
                this.progressbarTip.style.left = `${
                    (this.slider.scrollLeft /
                        (this.getSliderWidth() - this.slider.offsetWidth)) *
                    100
                }%`;
            } else {
                this.progressbarTip.style.left = `${
                    (window.scrollY / (this.getSliderWidth() / 2)) * 100
                }%`;
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
                let imageRect = document
                    .getElementById("artworkImage-" + this.artworkDetailId)
                    .getBoundingClientRect();

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
                    .to(
                        "#artworkImage-clone",
                        {
                            top: `calc(${imageRect.top}px - 4.5rem)`,
                            left: imageRect.left,
                            width: imageRect.width,
                            height: imageRect.height,
                            padding: 0,
                            duration: 0.3,
                            ease: Power2.easeOut,
                        },
                        ">-=0.2"
                    )
                    .fromTo(
                        "#artworkDetail",
                        {
                            backgroundColor: "rgba(255, 252, 248, 1)",
                        },
                        {
                            backgroundColor: "rgba(255, 252, 248, 0)",
                            duration: 0.3,
                            ease: Power2.easeInOut,
                            onComplete: () => {
                                this.openDetail = false;
                            },
                        }
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
                let textwrapper = document.getElementById(
                    "artworkDetailTextWrapper"
                );

                let image = document.getElementById("artworkImage-" + artwork);
                let imageRect = image.getBoundingClientRect();

                //change title description and categories
                this.artworkTitle = image.dataset.artworkTitle;
                this.artworkDescription = image.dataset.artworkDescription;
                this.artworkCategories =
                    image.dataset.artworkCategories.split("-");
                this.artworkCategories.forEach((item, index) => {
                    if (item == "") {
                        this.artworkCategories = [];
                    }
                });

                let clone = document
                    .getElementById("artworkImage-" + artwork)
                    .cloneNode();
                clone.removeAttribute("class");
                clone.classList.add("absolute");
                clone.id = "artworkImage-clone";

                clone.style.width = imageRect.width + "px";
                clone.style.height = imageRect.height + "px";
                clone.style.left = imageRect.left + "px";
                clone.style.top = `calc(${imageRect.top}px - 4.5rem)`;

                imagewrapper.appendChild(clone);

                let imageRatio =
                    parseInt(clone.style.width) / parseInt(clone.style.height);

                clone.dataset.imageRatio = imageRatio;

                let newImageWidth =
                    imagewrapper.getBoundingClientRect().width -
                    convertRemToPixels(3);

                let imageSetWidth = !isSmallScreen ? "66%" : "100%";

                window.setTimeout(() => {
                    let textwrapperRect = textwrapper.getBoundingClientRect();

                    this.detailTimeline = gsap
                        .timeline()
                        .fromTo(
                            "#artworkDetail",
                            {
                                backgroundColor: "rgba(255, 252, 248, 0)",
                            },
                            {
                                backgroundColor: "rgba(255, 252, 248, 1)",
                                duration: 0.2,
                                ease: Power2.easeInOut,
                            }
                        )
                        .to("#artworkImage-clone", {
                            top: `calc(${
                                textwrapperRect.top + textwrapperRect.height
                            }px - 4.5rem)`,
                            left: imagewrapper.getBoundingClientRect().left,
                            height: `${newImageWidth / imageRatio}px`,
                            padding: "0 3rem 3rem 3rem",
                            width: "100%",
                            duration: 0.4,
                            ease: Power2.easeOut,
                        })
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
                }, 100);
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
                        stagger: 0.02,
                    }
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
    if (!isSmallScreen) {
        scrollPos = getScrollPosition();
        if (clonesWidth + scrollPos >= sliderWidth) {
            window.scrollTo({ top: 1 });
        } else if (scrollPos <= 0) {
            window.scrollTo({ top: sliderWidth - clonesWidth - 1 });
        }

        slider.style.transform = `translateX(${-window.scrollY}px)`;
    }

    requestAnimationFrame(scrollUpdate);
}

function toSmall() {
    // remove all clones
    let clones = document.getElementsByClassName("clone");
    [...clones].forEach((item) => {
        item.hidden = true;
    });
    slider.style.transform = `translateX(0px)`;

    document.body.style.height = `${window.innerHeight}px`;
}

function toBig() {
    // remove all clones
    let clones = document.getElementsByClassName("clone");
    [...clones].forEach((item) => {
        item.hidden = false;
    });
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
        if (isSmallScreen) {
            clone.hidden = true;
        }
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

//window.addEventListener("load", (event) => {});
// Promise.all(
//     Array.from(document.images)
//         .filter((img) => !img.complete)
//         .map(
//             (img) =>
//                 new Promise((resolve) => {
//                     img.onload = img.onerror = function () {
//                         console.log("test");
//                     };
//                     // [...document.querySelectorAll(".imageCarouselItem")].forEach((item) => {
//                     //     item.style.width = item.dataset.originalWidth = `${
//                     //         item.getBoundingClientRect().width
//                     //     }px`;
//                     // });
//                 })
//         )
// ).then(() => {});

const imageCount = [...document.querySelectorAll(".imageCarouselImages")]
    .length;
let imageCounter = 0;
let loadingimgtimeline = gsap.timeline();

loadingimgtimeline
    .to("#loadingImgWrapper", {
        duration: 0.5,
        opacity: 0.2,
        scale: 1,
    })
    .pause();

[...document.querySelectorAll(".imageCarouselImages")].forEach((item) => {
    item.onload = function () {
        document.getElementById(
            `imageCarouselItem-${item.dataset.artworkId}`
        ).style.width = `${item.width}px`;
        document.getElementById(
            `imageCarouselItem-${item.dataset.artworkId}`
        ).dataset.originalWidth = `${item.width}px`;
        item.style.padding = "1rem";
        imageCounter++;

        document.getElementById("loadingPercentage").innerHTML = `${Math.round(
            (100 / imageCount) * imageCounter
        )}%`;

        if (loadingimgtimeline.isActive) {
            if (imageCounter % 3 == 0) {
                document.getElementById("loadingImg").src = item.src;
                loadingimgtimeline.restart();
            } else if (imageCounter == 0) {
                document.getElementById("loadingImg").src = item.src;
                loadingimgtimeline.restart();
            }
        }

        // on last onload start rest of page rendering
        if (imageCounter == imageCount) {
            console.log("start image rendering");
            documentHeight();

            if (window.innerWidth < 768) {
                isSmallScreen = true;
            } else {
                isSmallScreen = false;
            }

            if (loadingimgtimeline.isActive) {
                window.setTimeout(() => {
                    gsap.timeline()
                        .to("#loadingLogo", {
                            duration: 0.3,
                            top: "-20px",
                            ease: Power2.easeInOut,
                            opacity: 0,
                        })
                        .to(
                            "#loadingPerc",
                            {
                                duration: 0.3,
                                top: "-20px",
                                ease: Power2.easeInOut,
                                opacity: 0,
                            },
                            ">-=0.2"
                        )
                        .to(
                            "#loadingImg",
                            {
                                duration: 0.3,
                                scale: 0.8,
                                ease: Power2.easeInOut,
                                opacity: 0,
                            },
                            ">-=0.2"
                        )
                        .to("#loaderScreen", {
                            opacity: 0,
                            onComplete: () => {
                                document.getElementById(
                                    "loaderScreen"
                                ).style.display = "none";
                            },
                        });
                    onload();
                }, 1000);
            } else {
                gsap.timeline()
                    .to("#loadingLogo", {
                        duration: 0.3,
                        top: "-20px",
                        ease: Power2.easeInOut,
                        opacity: 0,
                    })
                    .to(
                        "#loadingPerc",
                        {
                            duration: 0.3,
                            top: "-20px",
                            ease: Power2.easeInOut,
                            opacity: 0,
                        },
                        ">-=0.2"
                    )
                    .to(
                        "#loadingImg",
                        {
                            duration: 0.3,
                            scale: 0.8,
                            ease: Power2.easeInOut,
                            opacity: 0,
                        },
                        ">-=0.2"
                    )
                    .to("#loaderScreen", {
                        opacity: 0,
                        onComplete: () => {
                            document.getElementById(
                                "loaderScreen"
                            ).style.display = "none";
                        },
                    });
                onload();
            }
        }
    };
});
[...document.querySelectorAll(".imageCarouselImages")].forEach((item) => {
    item.src = item.dataset.imgSrc;
});

const documentHeight = () => {
    const doc = document.documentElement;
    doc.style.setProperty("--doc-height", `${window.innerHeight}px`);
    doc.style.setProperty("--doc-height-neg", `-${window.innerHeight}px`);
};
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
    return (
        rem * parseFloat(getComputedStyle(document.documentElement).fontSize)
    );
}
