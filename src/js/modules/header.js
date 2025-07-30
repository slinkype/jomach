export default function header() {

	/* Header scroll class toggle */
	const win = window;
	const stickyNav = () => {
        
        let htmlEl = document.documentElement;

		if(htmlEl.scrollTop < 90) {
			htmlEl.classList.remove("header-is-scrolled");
		}else{
			htmlEl.classList.add("header-is-scrolled");
		}

	};

    win.addEventListener("scroll", () => {
        win.requestAnimationFrame(stickyNav);
    });
    stickyNav();

	function toggleMenu(menuLink, menuLinks){
		menuLink.classList.toggle("sub-menu-is-active");
		[...menuLinks].filter((e) => e !== menuLink).forEach((i) => i.classList.remove('sub-menu-is-active'));
		if(menuLink.classList.contains('sub-menu-is-active')){
			menuItemsWithChildrenParent.classList.add('mega-menu-is-active');
		}else{
			menuItemsWithChildrenParent.classList.remove('mega-menu-is-active');
		}
	}

	const menuLinks = document.querySelectorAll(".header .header-menu .main-menu > .menu-item-has-children");
	const menuItemsWithChildrenParent = document.querySelector(".header");
	[...menuLinks].forEach((menuLink)=>{
		let menuIndicator = document.createElement('span');
		menuIndicator.className = "sub-menu-indicator";
		menuLink.appendChild(menuIndicator);

		menuIndicator.addEventListener("click", () => {
			toggleMenu(menuLink, menuLinks);
		});
	});

	window.addEventListener('click', function(e){   
		if(document.querySelector('.sub-menu-is-active') && !document.querySelector('.header-menu').contains(e.target)){
			[...menuLinks].forEach((i) => i.classList.remove('sub-menu-is-active'));
			menuItemsWithChildrenParent.classList.remove('mega-menu-is-active');
		}
	});

	/* Burger Menu items indicator toggle */
	const burgerMenuLinks = document.querySelectorAll(".hamburger-content .main-menu > .menu-item-has-children");
	[...burgerMenuLinks].forEach((burgerMenuLink)=>{
		let menuIndicator = document.createElement('span');
		menuIndicator.className = "sub-menu-indicator";
		burgerMenuLink.appendChild(menuIndicator);

		menuIndicator.addEventListener("click", () => {
			burgerMenuLink.classList.toggle("sub-menu-is-active");
		});
	});

	/* Desktop Menu items indicator toggle */
	const desktopMenuLinks = document.querySelectorAll(".main-menu .sub-menu > .menu-item-has-children");
	[...desktopMenuLinks].forEach((desktopMenuLinks)=>{
		let menuIndicator = document.createElement('span');
		menuIndicator.className = "sub-menu-indicator";
		desktopMenuLinks.appendChild(menuIndicator);

		menuIndicator.addEventListener("click", () => {
			desktopMenuLinks.classList.toggle("sub-menu-is-active");
		});
	});

	const burgerToggles = document.querySelectorAll(".hamburger-toggle, .hamburger-overlay, .hamburger-content a");
	[...burgerToggles].forEach((el) => {
		el.addEventListener("click", () => {
			document.documentElement.classList.toggle("burger-is-active");
		});
	});

	const searchToggles = document.querySelectorAll(".header-search-toggle");
	[...searchToggles].forEach((el) => {
		el.addEventListener("click", () => {
			document.documentElement.classList.toggle("search-is-active");
		});
	});

}