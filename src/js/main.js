import header from './modules/header.js';
import { toggableItemGrid, slidersFix } from './modules/helpers.js'; 

/**
 * Header Mods
 */
if( document.querySelector('.header') ) header();

/**
 * Helpers functions, uncomment if used
 */
toggableItemGrid();

slidersFix();
