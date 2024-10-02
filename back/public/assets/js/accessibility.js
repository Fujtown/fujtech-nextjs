
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('accessibility-toggle');
    const sidebar = document.getElementById('accessibility-sidebar');
    const closeButton = document.getElementById('close-sidebar');
    const decreaseFont = document.getElementById('decrease-font');
    const increaseFont = document.getElementById('increase-font');

    let fontSize = 100;
    const minFontSize = 80;
    const maxFontSize = 120;

    toggleButton.addEventListener('click', () => {
        sidebar.classList.add('open');
    });

    closeButton.addEventListener('click', () => {
        sidebar.classList.remove('open');
    });

    decreaseFont.addEventListener('click', () => {
        if (fontSize > minFontSize) {
            fontSize -= 10;
            updateFontSize();
        }
    });

    increaseFont.addEventListener('click', () => {
        if (fontSize < maxFontSize) {
            fontSize += 10;
            updateFontSize();
        }
    });

    function updateFontSize() {
        document.body.style.fontSize = `${fontSize}%`;
        // Apply font size to all paragraph elements
    const paragraphs = document.getElementsByTagName('p');
    for (let i = 0; i < paragraphs.length; i++) {
        paragraphs[i].style.fontSize = `${fontSize}%`;
    }

    const headings = document.getElementsByTagName('h1');
    for (let i = 0; i < headings.length; i++) {
        headings[i].style.fontSize = `${fontSize}%`;
    }
    const h2s = document.getElementsByTagName('h2');
    for (let i = 0; i < h2s.length; i++) {
        if (!isInsideAccessibilitySidebar(h2s[i])) {
            h2s[i].style.fontSize = `${fontSize}%`;
        }
    }
    const h3s = document.getElementsByTagName('h3');
    for (let i = 0; i < h3s.length; i++) {
        h3s[i].style.fontSize = `${fontSize}%`;
    }
    const h4s = document.getElementsByTagName('h4');
    for (let i = 0; i < h4s.length; i++) {
        h4s[i].style.fontSize = `${fontSize}%`;
    }
    const h5s = document.getElementsByTagName('h5');
    for (let i = 0; i < h5s.length; i++) {
        h5s[i].style.fontSize = `${fontSize}%`;
    }
    const h6s = document.getElementsByTagName('h6');
    for (let i = 0; i < h6s.length; i++) {
        h6s[i].style.fontSize = `${fontSize}%`;
    }
    const spans = document.getElementsByTagName('span');
    for (let i = 0; i < spans.length; i++) {
        if (!isInsideAccessibilitySidebar(spans[i])) {
            spans[i].style.fontSize = `${fontSize}%`;
        }
    }
    const divs = document.getElementsByTagName('div');
    for (let i = 0; i < divs.length; i++) {
        if (!isInsideAccessibilitySidebar(divs[i])) {
            divs[i].style.fontSize = `${fontSize}%`;
        }
    }
    const links = document.getElementsByTagName('a');
    for (let i = 0; i < links.length; i++) {
        links[i].style.fontSize = `${fontSize}%`;
    }
    const buttons = document.getElementsByTagName('button');
    for (let i = 0; i < buttons.length; i++) {
        if (!isInsideAccessibilitySidebar(buttons[i])) {
            buttons[i].style.fontSize = `${fontSize}%`;
        }
    }
    const inputs = document.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].style.fontSize = `${fontSize}%`;
    }
    const labels = document.getElementsByTagName('label');
    for (let i = 0; i < labels.length; i++) {
        labels[i].style.fontSize = `${fontSize}%`;
    }
    const selects = document.getElementsByTagName('select');
    for (let i = 0; i < selects.length; i++) {
        selects[i].style.fontSize = `${fontSize}%`;
    }
    const textareas = document.getElementsByTagName('textarea');
    for (let i = 0; i < textareas.length; i++) {
        textareas[i].style.fontSize = `${fontSize}%`;
    }
    const tables = document.getElementsByTagName('table');
    for (let i = 0; i < tables.length; i++) {
        tables[i].style.fontSize = `${fontSize}%`;
    }
    const ths = document.getElementsByTagName('th');
    for (let i = 0; i < ths.length; i++) {
        ths[i].style.fontSize = `${fontSize}%`;
    }
    const tds = document.getElementsByTagName('td');
    for (let i = 0; i < tds.length; i++) {
        tds[i].style.fontSize = `${fontSize}%`;
    }
    const ul = document.getElementsByTagName('ul');
    for (let i = 0; i < ul.length; i++) {
        ul[i].style.fontSize = `${fontSize}%`;
    }
    const ol = document.getElementsByTagName('ol');
    for (let i = 0; i < ol.length; i++) {
        ol[i].style.fontSize = `${fontSize}%`;
    }
    const li = document.getElementsByTagName('li');
    for (let i = 0; i < li.length; i++) {
        li[i].style.fontSize = `${fontSize}%`;
    }
    const form = document.getElementsByTagName('form');
    for (let i = 0; i < form.length; i++) {
        form[i].style.fontSize = `${fontSize}%`;
    }
    const fieldset = document.getElementsByTagName('fieldset');
    for (let i = 0; i < fieldset.length; i++) {
        fieldset[i].style.fontSize = `${fontSize}%`;
    }
    const legend = document.getElementsByTagName('legend');
    for (let i = 0; i < legend.length; i++) {   
        legend[i].style.fontSize = `${fontSize}%`;
    }
    const textarea = document.getElementsByTagName('textarea');
    for (let i = 0; i < textarea.length; i++) {
        textarea[i].style.fontSize = `${fontSize}%`;
    }
    const table = document.getElementsByTagName('table');
    for (let i = 0; i < table.length; i++) {
        table[i].style.fontSize = `${fontSize}%`;
    }
    const th = document.getElementsByTagName('th');
    for (let i = 0; i < th.length; i++) {
        th[i].style.fontSize = `${fontSize}%`;
    }
    const td = document.getElementsByTagName('td');
    for (let i = 0; i < td.length; i++) {
        td[i].style.fontSize = `${fontSize}%`;
    }

    function isInsideAccessibilitySidebar(element) {
        let parent = element.parentElement;
        while (parent) {
            if (parent.id === 'accessibility-sidebar') {
                return true;
            }
            parent = parent.parentElement;
        }
        return false;
    }
    }
    const invertColorsButton = document.getElementById('invert-colors');
    const darkContrastButton = document.getElementById('dark-contrast');
    const lightContrastButton = document.getElementById('light-contrast');

    invertColorsButton.addEventListener('click', toggleInvertColors);
    darkContrastButton.addEventListener('click', applyDarkContrast);
    lightContrastButton.addEventListener('click', applyLightContrast);

    function toggleInvertColors() {
        console.log('Invert Colors');
        document.body.classList.toggle('inverted-colors');
        const elementTypes = ['p', 'h1', 'h2', 'h3', 'span', 'div', 'a', 'button', 'input', 'label', 'select', 'textarea', 'table', 'th', 'td', 'ul', 'ol', 'li', 'form', 'fieldset', 'legend', 'textarea', 'table', 'th', 'td'];

        elementTypes.forEach(type => {
            const elements = document.getElementsByTagName(type);
            for (let i = 0; i < elements.length; i++) {
                elements[i].style.color = '#fff';
            }
        });
    }

    function applyDarkContrast() {
        document.body.classList.remove('light-contrast');
        document.body.classList.add('dark-contrast');
        const elementTypes = ['p', 'h1', 'h2', 'h3', 'span', 'div', 'a', 'button', 'input', 'label', 'select', 'textarea', 'table', 'th', 'td', 'ul', 'ol', 'li', 'form', 'fieldset', 'legend', 'textarea', 'table', 'th', 'td'];

        elementTypes.forEach(type => {
            const elements = document.getElementsByTagName(type);
            for (let i = 0; i < elements.length; i++) {
                elements[i].style.color = '#fff ';
            }
        });
    }

    function applyLightContrast() {
        document.body.classList.remove('dark-contrast');
        document.body.classList.add('light-contrast');
        const elementTypes = ['p', 'h1', 'h2', 'h3', 'span', 'div', 'a', 'button', 'input', 'label', 'select', 'textarea', 'table', 'th', 'td', 'ul', 'ol', 'li', 'form', 'fieldset', 'legend', 'textarea', 'table', 'th', 'td'];

        elementTypes.forEach(type => {
            const elements = document.getElementsByTagName(type);
            for (let i = 0; i < elements.length; i++) {
                elements[i].style.color = '#000';
            }
        });
    }
    
    const bigCursorButton = document.getElementById('big-cursor');
    const readingMaskButton = document.getElementById('reading-mask');
    const readingGuideButton = document.getElementById('reading-guide');
    let readingMaskHeight = 200; // Default height of the reading mask window
    let readingMaskWidth = 1000;
    let isBigCursorActive = false;
    let isReadingMaskActive = false;
    let isReadingGuideActive = false;
    bigCursorButton.addEventListener('click', toggleBigCursor);
    readingMaskButton.addEventListener('click', toggleReadingMask);
    readingGuideButton.addEventListener('click', toggleReadingGuide);

    function toggleBigCursor() {
        isBigCursorActive = !isBigCursorActive;
        document.body.classList.toggle('big-cursor', isBigCursorActive);
        bigCursorButton.classList.toggle('active', isBigCursorActive);
    }

    function toggleReadingMask() {
        isReadingMaskActive = !isReadingMaskActive;
        if (isReadingMaskActive) {
            createReadingMask();
        } else {
            removeReadingMask();
        }
        readingMaskButton.classList.toggle('active', isReadingMaskActive);
    }
    function createReadingMask() {
        const maskTop = document.createElement('div');
        maskTop.id = 'reading-mask-top';
        const maskBottom = document.createElement('div');
        maskBottom.id = 'reading-mask-bottom';
        const maskLeft = document.createElement('div');
        maskLeft.id = 'reading-mask-left';
        const maskRight = document.createElement('div');
        maskRight.id = 'reading-mask-right';
    
        document.body.appendChild(maskTop);
        document.body.appendChild(maskBottom);
        document.body.appendChild(maskLeft);
        document.body.appendChild(maskRight);
    
        document.addEventListener('mousemove', updateReadingMask);
        document.addEventListener('wheel', adjustReadingMaskSize);
    }
    
    function updateReadingMask(e) {
        const halfHeight = readingMaskHeight / 2;
        const halfWidth = readingMaskWidth / 2;
    
        const maskTop = document.getElementById('reading-mask-top');
        const maskBottom = document.getElementById('reading-mask-bottom');
        const maskLeft = document.getElementById('reading-mask-left');
        const maskRight = document.getElementById('reading-mask-right');
    
        maskTop.style.height = `${e.clientY - halfHeight}px`;
        maskBottom.style.top = `${e.clientY + halfHeight}px`;
        maskLeft.style.width = `${e.clientX - halfWidth}px`;
        maskRight.style.left = `${e.clientX + halfWidth}px`;
    
        maskLeft.style.top = maskRight.style.top = `${e.clientY - halfHeight}px`;
        maskLeft.style.height = maskRight.style.height = `${readingMaskHeight}px`;
    }
    
    function adjustReadingMaskSize(e) {
        if (isReadingMaskActive) {
            e.preventDefault(); // Prevent normal scrolling
            if (e.ctrlKey) {
                // Adjust width when Ctrl key is pressed
                if (e.deltaY < 0) {
                    readingMaskWidth = Math.min(readingMaskWidth + 20, 1200); // Increase, max 1200px
                } else {
                    readingMaskWidth = Math.max(readingMaskWidth - 20, 200); // Decrease, min 200px
                }
            } else {
                // Adjust height when Ctrl key is not pressed
                if (e.deltaY < 0) {
                    readingMaskHeight = Math.min(readingMaskHeight + 10, 300); // Increase, max 300px
                } else {
                    readingMaskHeight = Math.max(readingMaskHeight - 10, 50); // Decrease, min 50px
                }
            }
            updateReadingMask(e);
        }
    }
    
    function removeReadingMask() {
        const masks = ['reading-mask-top', 'reading-mask-bottom', 'reading-mask-left', 'reading-mask-right'];
        masks.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                document.body.removeChild(element);
            }
        });
        document.removeEventListener('mousemove', updateReadingMask);
        document.removeEventListener('wheel', adjustReadingMaskSize);
    }
    
    

    function toggleReadingGuide() {
        isReadingGuideActive = !isReadingGuideActive;
        if (isReadingGuideActive) {
            createReadingGuide();
        } else {
            removeReadingGuide();
        }
        readingGuideButton.classList.toggle('active', isReadingGuideActive);
    }

    function createReadingGuide() {
        const guide = document.createElement('div');
        guide.id = 'reading-guide-line';
        document.body.appendChild(guide);

        document.addEventListener('mousemove', updateReadingGuide);
    }

    function updateReadingGuide(e) {
        const guide = document.getElementById('reading-guide-line');
        guide.style.top = e.clientY + 'px';
    }

    function removeReadingGuide() {
        const guide = document.getElementById('reading-guide-line');
        if (guide) {
            document.body.removeChild(guide);
        }
        document.removeEventListener('mousemove', updateReadingGuide);
    }
    

    const resetButton = document.getElementById('reset-accessibility');
    
    resetButton.addEventListener('click', resetAllSettings);

    function resetAllSettings() {
        // Reset font size
        fontSize = 100;
        updateFontSize();

        // Reset color inversion
        document.body.classList.remove('inverted-colors');

        // Reset contrast
        document.body.classList.remove('dark-contrast', 'light-contrast');

        // Reset any other settings you've implemented
        // ...

        // Remove any accessibility-related classes from elements
        const elements = document.querySelectorAll('p, h1, h2, h3, span');
        elements.forEach(element => {
            element.classList.remove('accessibility-white-text');
            element.style.color = ''; // Reset inline color style
        });

        // Clear localStorage
        localStorage.removeItem('accessibilityFontSize');
        // Remove any other accessibility-related items from localStorage
        // ...

        alert('All accessibility settings have been reset.');
    }

    
});