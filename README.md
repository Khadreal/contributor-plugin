# rtCamp Post Contributors Plugin Assessment

## 📌 Description
The ** Contributors** plugin allows multiple authors to be assigned to a post and displays them on the frontend. Contributors' names, avatars, and links to their author pages are shown at the end of each post.

## 🚀 Installation
### Installation Guide
1. Clone this repository.
2. Extract the contents and move the `contributor-plugin` folder to the `/wp-content/plugins/` directory.
3. cd to `/wp-content/plugins/contributor-plugin` directory and run `composer install`  
4. Activate the plugin via the WordPress **Plugins** menu.


## 🛠️ Usage
1. Edit a post in WordPress.
2. In the **Contributors** meta box, select the users to be listed as contributors.
3. Save the post. The contributors will be displayed at the end of the post.

## 🧪 Running Tests
### 1. Install Dependencies
Ensure you have **Composer** installed, then run:
```sh
composer install
```

### 2. Run PHPUnit Tests
Execute the tests using:
```sh
composer test-unit
```

## ✅ TODO
- Ensure contributor content appears on their **author archive pages**.
- Add support for pages
- Improve styling for the contributor section.
- Add more filters for customization.

