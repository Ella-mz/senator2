$(document).ready(function () {
    var swiper1 = new Swiper(".mySwiper1", {
        slidesPerView: 1,
        spaceBetween: 10,
        centeredSlides: false,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            1200: {
                slidesPerView: 5,
                centeredSlides: true,
            },
            768: {
                slidesPerView: 3,
                centeredSlides: true,
            },
            576: {
                slidesPerView: 2,
                centeredSlides: false,
            },
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
    });

    var swiper2 = new Swiper(".mySwiper2", {
        slidesPerView: 1,
        grid: {
            rows: 2,
        },
        spaceBetween: 30,
        centeredSlides: false,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            1200: {
                slidesPerView: 4,
                grid: {
                    rows: 2,
                },
            },
            991: {
                slidesPerView: 3,
                grid: {
                    rows: 2,
                },
            },
            576: {
                slidesPerView: 2,
                grid: {
                    rows: 2,
                },
            },
            300: {
                slidesPerView: 1,
                grid: {
                    rows: 1,
                },
            },
        },
    });

    var swiper3 = new Swiper(".mySwiper3", {
        slidesPerView: 1,
        spaceBetween: 20,
        centeredSlides: false,
        loop: true,
        autoplay: {
            delay: 2000,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            1200: {
                slidesPerView: 4,
            },
            991: {
                slidesPerView: 3,
            },
            576: {
                slidesPerView: 2,
            },
            300: {
                slidesPerView: 1,
            },
        },
    });

    var swiper4 = new Swiper(".mySwiper4", {
        slidesPerView: 1,
        centeredSlides: false,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            1300: {
                slidesPerView: 5,
                centeredSlides: true,
                spaceBetween: 0,
            },
            768: {
                slidesPerView: 3,
                centeredSlides: true,
                spaceBetween: 0,
            },
            576: {
                slidesPerView: 2,
            },
        },
        // autoplay: {
        //   delay:3000,
        //   disableOnInteraction: false,
        // },
    });

    //**** navigation ****//
    // const tabButton = document.querySelectorAll(".tab-navigation__tab-btn");
    // const tabContent = document.querySelectorAll(".tab-navigation__content");

    // tabContent[1].style.display = "block";

    // tabButton.forEach((item, index) => {
    //   item.addEventListener("click", () => {
    //     for (let i = 0; i < tabButton.length; i++)
    //       tabButton[i].classList.remove("selected");
    //     Navigation(item, index);
    //   });
    // });

    // const Navigation = (item, index) => {
    //   const contentTab = tabContent[index].getAttribute("id");
    //   item.classList.add("selected");

    //   for (let i = 0; i < tabContent.length; i++)
    //     tabContent[i].style.display = "none";
    //   document.getElementById(contentTab).style.display = "block";
    // };

    //****search city ****//
    let confirmButton = document.querySelector(".dolatsara__confirm-button");
    let form = document.querySelector("form.dolatsara__city-modal-form");
    let searchCityInput = document.getElementById("search-city");
    let cityInput = document.querySelectorAll("input.city-name");
    let selectedCity = document.querySelector("span.dolatsara__selected-city");
    let cityNameParent = document.querySelector(".dolatsara__city-name-parent");
    let selectAllInput = document.querySelector("input.select-all");
    let city = [];
    let icon = document.querySelectorAll(".delete-city");

    let deleteButton = document.querySelector(".dolatsara__delete-all");


    cityInput.forEach((item) => {
        item.addEventListener("change", (e) => {
            if (item.checked == true) {
        city.push(item.id);

        let div = document.createElement("div");
        let p = document.createElement("p");
        let i = document.createElement("i");

        div.setAttribute("class", "dolatsara__selected-city");
        p.setAttribute("class", "dolatsara__city-name");
        i.setAttribute("class", "material-icons delete-city");

        p.innerHTML = item.id;
        i.innerHTML = "close";

        div.appendChild(p);
        div.appendChild(i);
        cityNameParent.appendChild(div);
    } else {
        city = city.filter((i) => i !== item.id);
        let cityItem = document.querySelectorAll("div.dolatsara__selected-city");
        cityItem.forEach((i) => {
            if (i.children[0].innerHTML === item.id)
        cityNameParent.removeChild(i);
    });
    }

    if (city.length == cityInput.length) selectAllInput.checked = true;
    else selectAllInput.checked = false;
    removeCity()
});
});

    selectAllInput.addEventListener("change", (val) => {
        if (val.target.checked == true) {
        cityInput.forEach((item) => {
            if (!item.checked) {
            item.checked = true;
            city.push(item.id);

        }
    });

        let div = document.createElement("div");
        let p = document.createElement("p");
        let i = document.createElement("i");

        div.setAttribute("class", "dolatsara__selected-city");
        p.setAttribute("class", "dolatsara__city-name");
        i.setAttribute("class", "material-icons delete-city dolatsara__delete-all_close");

        p.innerHTML = 'همه ی شهرها';
        i.innerHTML = "close";

        div.appendChild(p);
        // div.appendChild(i);
        cityNameParent.appendChild(div);
        let closeButton = document.querySelector(".dolatsara__delete-all_close");

    } else {
        cityInput.forEach((item) => {
            item.checked = false;
        city = city.filter((i) => i !== item.id);
        let cityItem = document.querySelectorAll(
            "div.dolatsara__selected-city"
        );
        cityItem.forEach((i) => {
            if (i.children[0].innerHTML === item.id)
        cityNameParent.removeChild(i);
    });
    });
    }
    removeCity()
});

    const removeCity = () => {

        if (city.length) {
            icon = document.querySelectorAll(".delete-city");
            icon.forEach((item) => {
                item.addEventListener("click", () => {
                    const cityName = item.previousSibling.innerHTML;
            cityNameParent.removeChild(item.parentElement);
            cityInput.forEach((item) => {
                if (item.id === cityName) {
                item.checked = false;
                selectAllInput.checked = false;
            }
        });
        });
        });
            selectedCity.style.display = "none";
            deleteButton.style.display = "block";
        } else {
            selectedCity.style.display = "block";
            deleteButton.style.display = "none";
        }
    }

//     closeButton.addEventListener("click", () => {
//         city = [];
//     selectAllInput.checked = false;
//     cityInput.forEach((item) => (item.checked = false));
//     cityNameParent.innerHTML = "";
//     deleteButton.style.display = "none";
// });

    deleteButton.addEventListener("click", () => {
        city = [];
    selectAllInput.checked = false;
    cityInput.forEach((item) => (item.checked = false));
    cityNameParent.innerHTML = "";
    deleteButton.style.display = "none";
});

    confirmButton.addEventListener("click", () => {
        return form.submit();
});

    searchCityInput.addEventListener("input", () => {
        searchCity();
});

    function searchCity() {
        let txtValue;
        let ul = document.getElementById("dolatsara__city-list");
        let li = document.querySelectorAll("li.dolatsara__city-list-item");
        let filter = searchCityInput.value;

        for (let i = 0; i < li.length; i++) {
            let label = li[i].getElementsByTagName("label")[0];
            txtValue = label.textContent || label.innerText;

            if (txtValue.indexOf(filter) > -1) {
                li[i].style.display = "block";
            } else {
                li[i].style.display = "none";
            }
        }
    }
});
