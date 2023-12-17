function changeActiveState(clickedElement) {
    // Remove the "active" class from all navigation items
    var navigationItems = document.querySelectorAll('ul li a');
    navigationItems.forEach(function (item) {
        item.classList.remove('active');
    });

    // Add the "active" class to the clicked navigation item
    clickedElement.classList.add('active');
}