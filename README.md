# The Gems & Co. India

A premium, minimalistic frontend e-commerce web application for luxury jewelry.

## Overview
This repository contains the front-end implementation for a high-end jewelry boutique. It eschews complex frameworks in favor of clean, robust, and highly-performant vanilla HTML, CSS, and JavaScript.

## Features
- **Minimalist Aesthetic:** Clean typography, ample whitespace, and smooth 'fade-up' micro-animations.
- **Responsive Layout:** Perfectly scales from wide desktop monitors down to mobile devices.
- **Mock Backend:** LocalStorage-based robust mock backend allowing for user registration, user login, and cart state persistence.
- **Unified Components:** Consistent usage of reusable layouts for navigation, drop-downs, and footers across all pages.
- **Dynamic Cart:** Fully functional cart system reflecting additions, quantity adjustments, item removals, and dynamic total calculation.

## Architecture
- `index.html`: Storefront homepage featuring hero banner and featured collections.
- `shop.html`: Full catalog grid listing all available luxury pieces.
- `cart.html`: User's cart review interface.
- `contact.html`: Contact processing form.
- `login.html` & `register.html`: Standard user onboarding forms connected to LocalStorage.
- `styles.css`: Pure CSS design system handling layout, variables, and cross-page animations.
- `main.js`: Core mock backend handling form submissions, auth flow, and profile logout.
- `cart.js`: E-commerce functionality managing the cart state.
- `assets/`: Directory containing all high-resolution imagery.

## Setup
No build steps required. Simply clone the repository and open `index.html` in your web browser.

```bash
git clone https://github.com/aaryaa29/Gems-and-Co.git
cd Gems-and-Co
```
