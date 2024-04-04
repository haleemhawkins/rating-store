/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './product_page.php',
    './update_products_page.php',
    './render_products.php',
    './scripts/**/*.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/forms'),
  ],
}
