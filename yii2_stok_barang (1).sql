-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 04:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2_stok_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin', 5, 1730945009),
('Admin', 7, 1730945017),
('maintenance', 9, 1730950172),
('sandbag', 10, 1730952624),
('superadmin', 1, 1730169714),
('superadmin', 4, 1731036786),
('superadmin', 8, 1730252448),
('superadmin', 11, 1730952835);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `group_code`) VALUES
('/*', 3, NULL, NULL, NULL, 1729233880, 1729233880, NULL),
('/debug/*', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/debug/default/*', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/debug/default/db-explain', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/debug/default/download-mail', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/debug/default/index', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/debug/default/toolbar', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/debug/default/view', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/debug/user/*', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/debug/user/reset-identity', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/debug/user/set-identity', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/docs/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/docs/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/docs/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/docs/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/docs/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/docs/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/docs/view-docs', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/document/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/document/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/document/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/document/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/document/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/document/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/employee/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/employee/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/employee/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/employee/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/employee/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/employee/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/export-damaged', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/export-item-report', 3, NULL, NULL, NULL, 1731036360, 1731036360, NULL),
('/export/export-lending', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/export-log', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/export-log-single', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/export-main', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/export-repair', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/export-unit-report', 3, NULL, NULL, NULL, 1731036360, 1731036360, NULL),
('/export/export-xlsx', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/item-detail', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/warehouse', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/export/wh-dist', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/gii/*', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/gii/default/*', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/gii/default/action', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/gii/default/diff', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/gii/default/index', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/gii/default/preview', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/gii/default/view', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/item/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/dashboard-data', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/details', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/item-name', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/pic-upload', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/view-image', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/item/warehouse', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/lending/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/lending/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/lending/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/lending/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/lending/item-report-active', 3, NULL, NULL, NULL, 1731030003, 1731030003, NULL),
('/lending/lending-list', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/lending/list', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/lending/loan-unit', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/lending/unit-report-active', 3, NULL, NULL, NULL, 1731032938, 1731032938, NULL),
('/lending/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/lending/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/done-repair-log', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/edit-log', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/lending-log', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/repair-log', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/return-log', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/search-log', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/search-result', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/log/view-log', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/rbac/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/rbac/init', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/rbac/list', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/site/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/site/about', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/site/captcha', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/site/contact', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/site/error', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/site/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/site/login', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/site/logout', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/add-unit', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/available-lending', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/available-unit', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/broken-unit', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/bulk-add', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/bulk-add-preview', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/correction-search', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/correction-unit', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/damaged', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/finish-repair', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/item-detail', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/repair', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/return-unit', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/send-repair', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/unit-repair', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/unit/warehouse-distribution', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/*', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/auth-item-group/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/bulk-activate', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/bulk-deactivate', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/bulk-delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/grid-page-size', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/grid-sort', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/toggle-attribute', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth-item-group/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth/captcha', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth/change-own-password', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/auth/confirm-email', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth/confirm-email-receive', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth/confirm-registration-email', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth/login', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth/logout', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth/password-recovery', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth/password-recovery-receive', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/auth/registration', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/bulk-activate', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/bulk-deactivate', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/bulk-delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/grid-page-size', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/grid-sort', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/refresh-routes', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/set-child-permissions', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/set-child-routes', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/toggle-attribute', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/permission/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/bulk-activate', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/bulk-deactivate', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/bulk-delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/grid-page-size', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/grid-sort', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/set-child-permissions', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/set-child-roles', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/toggle-attribute', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/role/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-permission/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-permission/set', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user-permission/set-roles', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user-visit-log/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/bulk-activate', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/bulk-deactivate', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/bulk-delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/grid-page-size', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/grid-sort', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/toggle-attribute', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user-visit-log/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user/bulk-activate', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user/bulk-deactivate', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user/bulk-delete', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user/change-password', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user/create', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user/delete', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user/grid-page-size', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user/grid-sort', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user/index', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user/toggle-attribute', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user-management/user/update', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user-management/user/view', 3, NULL, NULL, NULL, 1729233881, 1729233881, NULL),
('/user/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user/generate-auth-keys', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user/toggle-status', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/user/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/warehouse/*', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/warehouse/create', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/warehouse/delete', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/warehouse/index', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/warehouse/item', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/warehouse/update', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('/warehouse/view', 3, NULL, NULL, NULL, 1730945389, 1730945389, NULL),
('Admin', 1, 'Warehouse Admin', NULL, NULL, 1729233881, 1730953614, NULL),
('App Admin', 2, 'App Admin', NULL, NULL, 1730954049, 1730954049, NULL),
('assignRolesToUsers', 2, 'Assign roles to users', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('base', 2, 'BASE. REQUIRED TO USE THE APP', NULL, NULL, 1730946802, 1730952596, 'base'),
('bindUserToIp', 2, 'Bind user to IP', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('bulk-documents', 2, 'bulk-documents', NULL, NULL, 1730949029, 1730949029, 'inventory-master'),
('changeOwnPassword', 2, 'Change own password', NULL, NULL, 1729233881, 1729233881, 'userCommonPermissions'),
('changeUserPassword', 2, 'Change user password', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('commonPermission', 2, 'Common permission', NULL, NULL, 1729233880, 1729233880, NULL),
('createUsers', 2, 'Create users', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('damaged-list', 2, 'Damaged Unit', NULL, NULL, 1730949678, 1730951532, 'maintenance'),
('deleteUsers', 2, 'Delete users', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('editUserEmail', 2, 'Edit user email', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('editUsers', 2, 'Edit users', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('employee', 2, 'Employee', NULL, NULL, 1730949984, 1730951475, 'employee'),
('god', 2, 'GOD MODE', NULL, NULL, 1730953358, 1730953358, 'god'),
('inventory-view', 2, 'inventory view only', NULL, NULL, 1730962928, 1730963079, 'inventory-master'),
('item-loan', 2, 'unit loaning', NULL, NULL, 1730949341, 1730949341, 'loaning'),
('loan-list', 2, 'loan-list & return', NULL, NULL, 1730949508, 1730949508, 'loaning'),
('loan-report', 2, 'loan-report', NULL, NULL, 1731032924, 1731032924, 'loaning'),
('log-view', 2, 'log-view', NULL, NULL, 1730949125, 1730949125, 'inventory-master'),
('maintenance', 1, 'Maintenance & Repair Officer', NULL, NULL, 1730943897, 1730953864, NULL),
('manage-unit', 2, 'manage-unit', NULL, NULL, 1730948658, 1730948658, 'inventory-master'),
('manageItems', 2, 'Manage items', NULL, NULL, 1730169714, 1730169714, NULL),
('master-inventory', 2, 'master-inventory', NULL, NULL, 1730944559, 1730947946, 'inventory-master'),
('repair-list', 2, 'Unit In-repair', NULL, NULL, 1730950949, 1730951420, 'maintenance'),
('sandbag', 1, 'rbac test', NULL, NULL, 1730952500, 1730952500, NULL),
('superadmin', 1, 'App Admin', NULL, NULL, 1730169714, 1730953801, NULL),
('viewItems', 2, 'View items', NULL, NULL, 1730169714, 1730169714, NULL),
('viewRegistrationIp', 2, 'View registration IP', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('viewUserEmail', 2, 'View user email', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('viewUserRoles', 2, 'View user roles', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('viewUsers', 2, 'View users', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('viewVisitLog', 2, 'View visit log', NULL, NULL, 1729233881, 1729233881, 'userManagement'),
('warehouse', 2, 'Warehouse', NULL, NULL, 1730949846, 1730951487, 'warehouse'),
('warehouse-view', 2, 'warehouse-view-only', NULL, NULL, 1730964440, 1730964440, 'warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Admin', 'base'),
('Admin', 'bulk-documents'),
('Admin', 'changeOwnPassword'),
('Admin', 'damaged-list'),
('Admin', 'employee'),
('Admin', 'item-loan'),
('Admin', 'loan-list'),
('Admin', 'loan-report'),
('Admin', 'log-view'),
('Admin', 'manage-unit'),
('Admin', 'master-inventory'),
('Admin', 'warehouse'),
('App Admin', '/user-management/user-visit-log/*'),
('App Admin', 'assignRolesToUsers'),
('App Admin', 'base'),
('App Admin', 'bindUserToIp'),
('App Admin', 'bulk-documents'),
('App Admin', 'changeOwnPassword'),
('App Admin', 'changeUserPassword'),
('App Admin', 'createUsers'),
('App Admin', 'damaged-list'),
('App Admin', 'deleteUsers'),
('App Admin', 'editUserEmail'),
('App Admin', 'editUsers'),
('App Admin', 'employee'),
('App Admin', 'item-loan'),
('App Admin', 'loan-list'),
('App Admin', 'log-view'),
('App Admin', 'manage-unit'),
('App Admin', 'manageItems'),
('App Admin', 'master-inventory'),
('App Admin', 'repair-list'),
('App Admin', 'viewItems'),
('App Admin', 'viewRegistrationIp'),
('App Admin', 'viewUserEmail'),
('App Admin', 'viewUserRoles'),
('App Admin', 'viewUsers'),
('App Admin', 'viewVisitLog'),
('App Admin', 'warehouse'),
('assignRolesToUsers', '/user-management/user-permission/set'),
('assignRolesToUsers', '/user-management/user-permission/set-roles'),
('assignRolesToUsers', 'viewUserRoles'),
('assignRolesToUsers', 'viewUsers'),
('base', '/site/*'),
('bulk-documents', '/docs/index'),
('bulk-documents', '/docs/update'),
('bulk-documents', '/docs/view'),
('bulk-documents', '/docs/view-docs'),
('changeOwnPassword', '/user-management/auth/change-own-password'),
('changeUserPassword', '/user-management/user/change-password'),
('changeUserPassword', 'viewUsers'),
('createUsers', '/user-management/user/create'),
('createUsers', 'viewUsers'),
('damaged-list', '/export/export-damaged'),
('damaged-list', '/unit/damaged'),
('damaged-list', '/unit/send-repair'),
('deleteUsers', '/user-management/user/bulk-delete'),
('deleteUsers', '/user-management/user/delete'),
('deleteUsers', 'viewUsers'),
('editUserEmail', 'viewUserEmail'),
('editUsers', '/user-management/user/bulk-activate'),
('editUsers', '/user-management/user/bulk-deactivate'),
('editUsers', '/user-management/user/update'),
('editUsers', 'viewUsers'),
('employee', '/employee/*'),
('god', '/*'),
('god', 'assignRolesToUsers'),
('god', 'base'),
('god', 'bindUserToIp'),
('god', 'bulk-documents'),
('god', 'changeOwnPassword'),
('god', 'changeUserPassword'),
('god', 'createUsers'),
('god', 'damaged-list'),
('god', 'deleteUsers'),
('god', 'editUserEmail'),
('god', 'editUsers'),
('god', 'employee'),
('god', 'item-loan'),
('god', 'loan-list'),
('god', 'log-view'),
('god', 'manage-unit'),
('god', 'manageItems'),
('god', 'master-inventory'),
('god', 'repair-list'),
('god', 'viewItems'),
('god', 'viewRegistrationIp'),
('god', 'viewUserEmail'),
('god', 'viewUserRoles'),
('god', 'viewUsers'),
('god', 'viewVisitLog'),
('god', 'warehouse'),
('inventory-view', '/export/export-main'),
('inventory-view', '/export/item-detail'),
('inventory-view', '/item/dashboard-data'),
('inventory-view', '/item/details'),
('inventory-view', '/item/index'),
('inventory-view', '/item/item-name'),
('inventory-view', '/item/view'),
('inventory-view', '/item/view-image'),
('inventory-view', '/item/warehouse'),
('item-loan', '/lending/create'),
('item-loan', '/lending/index'),
('item-loan', '/lending/loan-unit'),
('loan-list', '/export/export-lending'),
('loan-list', '/lending/lending-list'),
('loan-list', '/lending/list'),
('loan-list', '/lending/update'),
('loan-list', '/unit/return-unit'),
('loan-report', '/export/export-item-report'),
('loan-report', '/export/export-unit-report'),
('loan-report', '/lending/item-report-active'),
('loan-report', '/lending/unit-report-active'),
('log-view', '/export/export-log'),
('log-view', '/export/export-log-single'),
('log-view', '/log/edit-log'),
('log-view', '/log/index'),
('log-view', '/log/search-result'),
('log-view', '/log/view'),
('log-view', '/log/view-log'),
('maintenance', 'base'),
('maintenance', 'changeOwnPassword'),
('maintenance', 'damaged-list'),
('maintenance', 'inventory-view'),
('maintenance', 'log-view'),
('maintenance', 'repair-list'),
('maintenance', 'warehouse'),
('manage-unit', '/unit/add-unit'),
('manage-unit', '/unit/available-lending'),
('manage-unit', '/unit/available-unit'),
('manage-unit', '/unit/bulk-add'),
('manage-unit', '/unit/bulk-add-preview'),
('manage-unit', '/unit/create'),
('manage-unit', '/unit/delete'),
('manage-unit', '/unit/index'),
('manage-unit', '/unit/update'),
('manage-unit', '/unit/view'),
('master-inventory', '/export/export-main'),
('master-inventory', '/export/item-detail'),
('master-inventory', '/export/wh-dist'),
('master-inventory', '/item/*'),
('master-inventory', '/item/create'),
('master-inventory', '/item/dashboard-data'),
('master-inventory', '/item/delete'),
('master-inventory', '/item/details'),
('master-inventory', '/item/index'),
('master-inventory', '/item/item-name'),
('master-inventory', '/item/pic-upload'),
('master-inventory', '/item/update'),
('master-inventory', '/item/view'),
('master-inventory', '/item/view-image'),
('master-inventory', '/item/warehouse'),
('master-inventory', '/unit/correction-search'),
('master-inventory', '/unit/correction-unit'),
('master-inventory', 'viewItems'),
('repair-list', '/export/export-repair'),
('repair-list', '/unit/finish-repair'),
('repair-list', '/unit/repair'),
('sandbag', 'base'),
('sandbag', 'inventory-view'),
('sandbag', 'log-view'),
('sandbag', 'warehouse-view'),
('superadmin', 'App Admin'),
('superadmin', 'assignRolesToUsers'),
('superadmin', 'base'),
('superadmin', 'bindUserToIp'),
('superadmin', 'bulk-documents'),
('superadmin', 'changeOwnPassword'),
('superadmin', 'changeUserPassword'),
('superadmin', 'createUsers'),
('superadmin', 'damaged-list'),
('superadmin', 'deleteUsers'),
('superadmin', 'editUserEmail'),
('superadmin', 'editUsers'),
('superadmin', 'employee'),
('superadmin', 'inventory-view'),
('superadmin', 'item-loan'),
('superadmin', 'loan-list'),
('superadmin', 'loan-report'),
('superadmin', 'log-view'),
('superadmin', 'manage-unit'),
('superadmin', 'manageItems'),
('superadmin', 'master-inventory'),
('superadmin', 'repair-list'),
('superadmin', 'viewItems'),
('superadmin', 'viewRegistrationIp'),
('superadmin', 'viewUserEmail'),
('superadmin', 'viewUserRoles'),
('superadmin', 'viewUsers'),
('superadmin', 'viewVisitLog'),
('superadmin', 'warehouse'),
('viewUsers', '/user-management/user/grid-page-size'),
('viewUsers', '/user-management/user/index'),
('viewUsers', '/user-management/user/view'),
('warehouse', '/warehouse/*'),
('warehouse-view', '/warehouse/*'),
('warehouse-view', '/warehouse/index'),
('warehouse-view', '/warehouse/item'),
('warehouse-view', '/warehouse/view');

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_group`
--

CREATE TABLE `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_item_group`
--

INSERT INTO `auth_item_group` (`code`, `name`, `created_at`, `updated_at`) VALUES
('admin-list', 'admin-list', 1730944343, 1730944343),
('base', 'BASE. REQUIRED TO USE THE APP', 1730952588, 1730952588),
('bulk-history', 'bulk-history', 1730944208, 1730944208),
('docs', 'docs', 1730944385, 1730944385),
('employee', 'employee', 1730944330, 1730944330),
('export', 'export', 1730944397, 1730944397),
('god', 'GOD MODE', 1730953336, 1730953336),
('inventory-master', 'inventory-master', 1730944142, 1730944142),
('loaning', 'loaning', 1730944247, 1730944247),
('maintenance', 'maintenance', 1730944271, 1730946203),
('manage-unit', 'manage-unit', 1730944191, 1730944191),
('unit-log', 'unit-log', 1730944222, 1730944222),
('userCommonPermissions', 'User common permission', 1729233881, 1729233881),
('userManagement', 'User management', 1729233881, 1729233881),
('warehouse', 'warehouse', 1730944302, 1730944302);

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `condition_lookup`
--

CREATE TABLE `condition_lookup` (
  `id_condition` tinyint(3) UNSIGNED NOT NULL,
  `condition_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `condition_lookup`
--

INSERT INTO `condition_lookup` (`id_condition`, `condition_name`) VALUES
(1, 'OK'),
(2, 'Lightly damaged (minor damage)'),
(3, 'Moderately damaged (missing a part or component)'),
(4, 'Major damage (inoperable, repair required)'),
(5, 'Total loss');

-- --------------------------------------------------------

--
-- Table structure for table `doc_uploaded`
--

CREATE TABLE `doc_uploaded` (
  `id_doc` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `datetime` datetime(2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc_uploaded`
--

INSERT INTO `doc_uploaded` (`id_doc`, `file_name`, `datetime`, `user_id`) VALUES
(1, 'bulk_unit651_1730948866.xlsx', '2024-11-07 10:07:46.00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` int(10) UNSIGNED NOT NULL,
  `emp_name` varchar(60) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `emp_name`, `phone`, `email`, `address`) VALUES
(1, 'johan tumbal', '0888888', 'ayymail@lmao.com', 'jalan jalan aj'),
(2, 'Emma', '0812121211212', 'emma@mail.com', 'a random street name'),
(3, 'Tumbal', '08080808', 'tumbal@mail.com', 'jalan gk tau'),
(4, 'Freddy', '0821321321', 'freddymail@mail.com', 'somewhere in a city'),
(5, 'Shioriiiin', '081684316487', 'shiorin@ayymail.com', 'idk somewhere a');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(60) NOT NULL,
  `SKU` varchar(50) NOT NULL,
  `imagefile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `item_name`, `SKU`, `imagefile`) VALUES
(11, 'Generic Phone', 'BOGD-44', '629_1730945999.jpg'),
(12, 'Generic Laptop', 'OJWL-41', '826_1730358216.gif'),
(13, 'Generic Keyboard', 'BNKH-93', '518_1730358229.gif'),
(14, 'Mousey Mouse', 'RGTD-6', '731_1730358250.jpeg'),
(15, 'Generic item for stress test', 'OTLP-31', '447_1730358126.webp'),
(16, 'SKU unique check', 'UGSI-9059', '202_1730358264.jpeg'),
(18, 'SKU new format check 2', 'WX95-54EB', '442_1730358314.webp'),
(25, 'more pic test edit 2', 'UD31-64DI', '815_1730359753.webp'),
(26, 'rbac test', 'PU87-69AN', '193_1730948742.gif');

-- --------------------------------------------------------

--
-- Table structure for table `item_unit`
--

CREATE TABLE `item_unit` (
  `id_unit` int(10) UNSIGNED NOT NULL,
  `id_item` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `id_wh` int(10) UNSIGNED DEFAULT NULL,
  `comment` varchar(60) DEFAULT NULL,
  `serial_number` varchar(60) NOT NULL,
  `condition` tinyint(3) UNSIGNED NOT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_unit`
--

INSERT INTO `item_unit` (`id_unit`, `id_item`, `status`, `id_wh`, `comment`, `serial_number`, `condition`, `updated_by`) VALUES
(58, 11, 1, 7, 'rbac test 3', 'BOG5409', 1, 5),
(59, 11, 1, 6, 'test add new unit', 'BOG-7848', 1, NULL),
(60, 11, 2, 5, 'finish repair test', 'BOG-2254', 1, 5),
(61, 11, 3, NULL, 'test add new unit', 'BOG-0642', 3, 8),
(62, 11, 1, 11, 'test rbac', 'BOG-6089', 2, 9),
(63, 11, 1, 8, 'edit test', 'BOG-7894', 2, NULL),
(64, 11, 2, 5, 'test add new unit', 'BOG-0790', 1, 5),
(65, 11, 3, NULL, 'test add new unit', 'BOG-0346', 2, 8),
(66, 11, 3, NULL, 'test add new unit', 'BOG-3217', 3, 8),
(67, 11, 1, 7, 'test add new unit', 'BOG-7480', 1, NULL),
(68, 11, 4, 7, 'test add new unit', 'BOG-4594', 4, 8),
(69, 11, 1, 5, 'test add new unit', 'BOG-3363', 1, NULL),
(70, 11, 2, 7, 'test add new unit', 'BOG-2006', 1, 5),
(71, 12, 1, 5, 'test add new unit', 'OJW-5143', 1, NULL),
(72, 12, 3, NULL, 'rbac test', 'OJW-5757', 3, 5),
(73, 12, 1, 7, 'test add new unit', 'OJW-6303', 1, NULL),
(74, 13, 1, NULL, 'test add new unit', 'BNK-0338', 1, NULL),
(75, 13, 1, 5, '', 'BNK-7156', 1, NULL),
(76, 13, 1, 7, 'test add new unit', 'BNK-2251', 1, NULL),
(77, 13, 1, 7, 'test add new unit', 'BNK-6793', 1, NULL),
(78, 14, 1, 9, 'test add new unit', 'RGT-2537', 1, NULL),
(79, 14, 1, 5, '', 'RGT-2175', 1, NULL),
(80, 14, 1, 5, 'test add new unit', 'RGT-6288', 1, NULL),
(81, 13, 1, 9, 'edit test', 'BNK-9582', 1, NULL),
(82, 13, 1, 8, 'edit test', 'BNK-1702', 1, 5),
(83, 14, 1, NULL, '', 'RGT-6039', 1, NULL),
(84, 14, 1, 8, 'rbac test', 'RGT-1395', 1, 5),
(85, 14, 1, 5, 'New Unit', 'RGT-9633', 1, NULL),
(87, 11, 1, 5, 'mass upload test', 'BOG-670', 1, 5),
(88, 11, 2, 6, 'mass upload test', 'BOG-389', 1, 1),
(89, 11, 1, 7, 'mass upload test', 'BOG-460', 1, 5),
(90, 11, 1, 8, 'mass upload test', 'BOG-932', 1, 5),
(91, 11, 1, 9, 'mass upload test', 'BOG-623', 1, 5),
(92, 11, 1, 5, 'mass upload test', 'BOG-297', 1, 5),
(93, 11, 1, 6, 'mass upload test', 'BOG-263', 1, 5),
(94, 11, 1, 7, 'mass upload test', 'BOG-784', 1, 5),
(95, 11, 2, 8, 'eyy', 'BOG-261', 1, 5),
(96, 11, 2, 9, 'mass upload test', 'BOG-914', 1, 5),
(97, 14, 1, 5, 'mass upload test', 'RGT-908', 1, 5),
(98, 14, 1, 6, 'mass upload test', 'RGT-882', 1, 5),
(99, 14, 1, 7, 'mass upload test', 'RGT-567', 1, 5),
(100, 14, 1, 8, 'mass upload test', 'RGT-614', 1, 5),
(101, 14, 1, 9, 'mass upload test', 'RGT-848', 1, 5),
(102, 14, 1, 5, 'mass upload test', 'RGT-780', 1, 5),
(103, 14, 1, 6, 'mass upload test', 'RGT-197', 1, 5),
(104, 14, 1, 7, 'mass upload test', 'RGT-389', 1, 5),
(105, 14, 1, 8, 'mass upload test', 'RGT-105', 1, 5),
(106, 14, 1, 9, 'mass upload test', 'RGT-51', 1, 5),
(107, 14, 1, 5, 'mass upload test', 'RGT-880', 1, 5),
(108, 14, 1, 6, 'mass upload test', 'RGT-626', 1, 5),
(109, 14, 1, 7, 'mass upload test', 'RGT-403', 1, 5),
(110, 14, 1, 8, 'mass upload test', 'RGT-110', 1, 5),
(111, 14, 1, 9, 'mass upload test', 'RGT-946', 1, 5),
(112, 14, 1, 5, 'mass upload test', 'RGT-577', 1, 5),
(113, 14, 1, 6, 'mass upload test', 'RGT-805', 1, 5),
(114, 14, 1, 7, 'mass upload test', 'RGT-583', 1, 5),
(115, 14, 1, 8, 'mass upload test', 'RGT-268', 1, 5),
(116, 14, 1, 9, 'mass upload test', 'RGT-372', 1, 5),
(53303, 16, 1, 6, 'test add new unit', 'UGSI-31JEAB', 1, 4),
(53304, 16, 1, 6, 'test add new unit', 'UGSI-85EDXN74', 1, 4),
(53305, 16, 1, 10, 'New Unit', 'UGSI-31XB39FY', 1, 4),
(53306, 16, 1, 8, 'test add new unit', 'UGSI-4994KW', 1, 4),
(53307, 18, 1, 8, 'test add new unit', 'WX95-1911YK', 1, 4),
(53308, 18, 2, 5, 'test add new unit  new autogenerate format', 'WX95-8225CZ-GH', 1, 4),
(53309, 18, 1, 7, 'new format check', 'WX95-4898QB-TN', 1, 4),
(53910, 15, 1, 10, 'huge rows bulk add', 'OTLP-0341TX-VW', 1, 4),
(53911, 15, 1, 10, 'huge rows bulk add', 'OTLP-1777JP-NI', 1, 4),
(53912, 15, 1, 10, 'huge rows bulk add', 'OTLP-2794KB-OI', 1, 4),
(53913, 15, 1, 10, 'huge rows bulk add', 'OTLP-4273WV-ZV', 1, 4),
(53914, 15, 1, 10, 'huge rows bulk add', 'OTLP-2127OT-MC', 1, 4),
(53915, 15, 1, 10, 'huge rows bulk add', 'OTLP-7757BH-AH', 1, 4),
(53916, 15, 1, 10, 'huge rows bulk add', 'OTLP-8494WD-LI', 1, 4),
(53917, 15, 1, 10, 'huge rows bulk add', 'OTLP-8339FT-RZ', 1, 4),
(53918, 15, 1, 10, 'huge rows bulk add', 'OTLP-6031UI-WJ', 1, 4),
(53919, 15, 1, 10, 'huge rows bulk add', 'OTLP-6272VS-EK', 1, 4),
(53920, 15, 1, 10, 'huge rows bulk add', 'OTLP-7921KX-NM', 1, 4),
(53921, 15, 1, 10, 'huge rows bulk add', 'OTLP-7547VH-EE', 1, 4),
(53922, 15, 1, 10, 'huge rows bulk add', 'OTLP-0042WY-NI', 1, 4),
(53923, 15, 1, 10, 'huge rows bulk add', 'OTLP-6385ZI-DT', 1, 4),
(53924, 15, 1, 10, 'huge rows bulk add', 'OTLP-7354KV-QJ', 1, 4),
(53925, 15, 1, 10, 'huge rows bulk add', 'OTLP-1596IO-CJ', 1, 4),
(53926, 15, 1, 10, 'huge rows bulk add', 'OTLP-2651WC-TF', 1, 4),
(53927, 15, 1, 10, 'huge rows bulk add', 'OTLP-6860RL-OL', 1, 4),
(53928, 15, 1, 10, 'huge rows bulk add', 'OTLP-7181SJ-ID', 1, 4),
(53929, 15, 1, 10, 'huge rows bulk add', 'OTLP-6432BY-QX', 1, 4),
(53930, 15, 1, 10, 'huge rows bulk add', 'OTLP-3536ZI-FC', 1, 4),
(53931, 15, 1, 10, 'huge rows bulk add', 'OTLP-8779PD-XQ', 1, 4),
(53932, 15, 1, 10, 'huge rows bulk add', 'OTLP-8998CX-ID', 1, 4),
(53933, 15, 1, 10, 'huge rows bulk add', 'OTLP-4241TF-KP', 1, 4),
(53934, 15, 1, 10, 'huge rows bulk add', 'OTLP-2678AN-UT', 1, 4),
(53935, 15, 1, 10, 'huge rows bulk add', 'OTLP-7510OI-YS', 1, 4),
(53936, 15, 1, 10, 'huge rows bulk add', 'OTLP-5085CA-DC', 1, 4),
(53937, 15, 1, 10, 'huge rows bulk add', 'OTLP-1852PT-YA', 1, 4),
(53938, 15, 1, 10, 'huge rows bulk add', 'OTLP-7071JR-ZH', 1, 4),
(53939, 15, 1, 10, 'huge rows bulk add', 'OTLP-5303HD-OF', 1, 4),
(53940, 15, 1, 10, 'huge rows bulk add', 'OTLP-4249KO-OS', 1, 4),
(53941, 15, 1, 10, 'huge rows bulk add', 'OTLP-6706UO-PM', 1, 4),
(53942, 15, 1, 10, 'huge rows bulk add', 'OTLP-5401DR-BF', 1, 4),
(53943, 15, 1, 10, 'huge rows bulk add', 'OTLP-4646SQ-CC', 1, 4),
(53944, 15, 1, 10, 'huge rows bulk add', 'OTLP-1027GO-GZ', 1, 4),
(53945, 15, 1, 10, 'huge rows bulk add', 'OTLP-9846HE-BK', 1, 4),
(53946, 15, 1, 10, 'huge rows bulk add', 'OTLP-9710HD-IN', 1, 4),
(53947, 15, 1, 10, 'huge rows bulk add', 'OTLP-1409ZA-NE', 1, 4),
(53948, 15, 1, 10, 'huge rows bulk add', 'OTLP-6342XR-KZ', 1, 4),
(53949, 15, 1, 10, 'huge rows bulk add', 'OTLP-7150HQ-YM', 1, 4),
(53950, 15, 1, 10, 'huge rows bulk add', 'OTLP-5914LD-DH', 1, 4),
(53951, 15, 1, 10, 'huge rows bulk add', 'OTLP-4391DM-NT', 1, 4),
(53952, 15, 1, 10, 'huge rows bulk add', 'OTLP-0507HU-LA', 1, 4),
(53953, 15, 1, 10, 'huge rows bulk add', 'OTLP-6195NE-AS', 1, 4),
(53954, 15, 1, 10, 'huge rows bulk add', 'OTLP-1808RN-UB', 1, 4),
(53955, 15, 1, 10, 'huge rows bulk add', 'OTLP-6782QO-LO', 1, 4),
(53956, 15, 1, 10, 'huge rows bulk add', 'OTLP-5102EX-KQ', 1, 4),
(53957, 15, 1, 10, 'huge rows bulk add', 'OTLP-7900UL-OT', 1, 4),
(53958, 15, 1, 10, 'huge rows bulk add', 'OTLP-5427GK-YQ', 1, 4),
(53959, 15, 1, 10, 'huge rows bulk add', 'OTLP-7732GO-HR', 1, 4),
(53960, 15, 1, 10, 'huge rows bulk add', 'OTLP-2640HB-AP', 1, 4),
(53961, 15, 1, 10, 'huge rows bulk add', 'OTLP-0361RF-BH', 1, 4),
(53962, 15, 1, 10, 'huge rows bulk add', 'OTLP-2743IV-WW', 1, 4),
(53963, 15, 1, 10, 'huge rows bulk add', 'OTLP-5406ZF-VC', 1, 4),
(53964, 15, 1, 10, 'huge rows bulk add', 'OTLP-4997LP-LM', 1, 4),
(53965, 15, 1, 10, 'huge rows bulk add', 'OTLP-1409RH-HA', 1, 4),
(53966, 15, 1, 10, 'huge rows bulk add', 'OTLP-8061GR-SC', 1, 4),
(53967, 15, 1, 10, 'huge rows bulk add', 'OTLP-2990PG-UW', 1, 4),
(53968, 15, 1, 10, 'huge rows bulk add', 'OTLP-5901UB-WU', 1, 4),
(53969, 15, 1, 10, 'huge rows bulk add', 'OTLP-7985KN-LC', 1, 4),
(53970, 15, 1, 10, 'huge rows bulk add', 'OTLP-9117HT-CR', 1, 4),
(53971, 15, 1, 10, 'huge rows bulk add', 'OTLP-0765TO-IG', 1, 4),
(53972, 15, 1, 10, 'huge rows bulk add', 'OTLP-0302LF-JT', 1, 4),
(53973, 15, 1, 10, 'huge rows bulk add', 'OTLP-2205JI-AP', 1, 4),
(53974, 15, 1, 10, 'huge rows bulk add', 'OTLP-8940IH-LH', 1, 4),
(53975, 15, 1, 10, 'huge rows bulk add', 'OTLP-6422YO-IF', 1, 4),
(53976, 15, 1, 10, 'huge rows bulk add', 'OTLP-7687ZD-AO', 1, 4),
(53977, 15, 1, 10, 'huge rows bulk add', 'OTLP-5123PA-OA', 1, 4),
(53978, 15, 1, 10, 'huge rows bulk add', 'OTLP-0263LF-PY', 1, 4),
(53979, 15, 1, 10, 'huge rows bulk add', 'OTLP-9131TL-TX', 1, 4),
(53980, 15, 1, 10, 'huge rows bulk add', 'OTLP-3138OO-LS', 1, 4),
(53981, 15, 1, 10, 'huge rows bulk add', 'OTLP-9965DF-WS', 1, 4),
(53982, 15, 1, 10, 'huge rows bulk add', 'OTLP-0735FM-JO', 1, 4),
(53983, 15, 1, 10, 'huge rows bulk add', 'OTLP-0906UP-QF', 1, 4),
(53984, 15, 1, 10, 'huge rows bulk add', 'OTLP-3415OW-TD', 1, 4),
(53985, 15, 1, 10, 'huge rows bulk add', 'OTLP-1858HJ-UU', 1, 4),
(53986, 15, 1, 10, 'huge rows bulk add', 'OTLP-6964XA-TF', 1, 4),
(53987, 15, 1, 10, 'huge rows bulk add', 'OTLP-3319ZK-XQ', 1, 4),
(53988, 15, 1, 10, 'huge rows bulk add', 'OTLP-5379EV-JZ', 1, 4),
(53989, 15, 1, 10, 'huge rows bulk add', 'OTLP-4965TA-YZ', 1, 4),
(53990, 15, 1, 10, 'huge rows bulk add', 'OTLP-9968RT-OZ', 1, 4),
(53991, 15, 1, 10, 'huge rows bulk add', 'OTLP-7614FT-QQ', 1, 4),
(53992, 15, 1, 10, 'huge rows bulk add', 'OTLP-0944VL-IA', 1, 4),
(53993, 15, 1, 10, 'huge rows bulk add', 'OTLP-4801BX-YU', 1, 4),
(53994, 15, 1, 10, 'huge rows bulk add', 'OTLP-8122JK-BQ', 1, 4),
(53995, 15, 1, 10, 'huge rows bulk add', 'OTLP-2982HC-XG', 1, 4),
(53996, 15, 1, 10, 'huge rows bulk add', 'OTLP-9838HE-OR', 1, 4),
(53997, 15, 1, 10, 'huge rows bulk add', 'OTLP-1807VS-MH', 1, 4),
(53998, 15, 1, 10, 'huge rows bulk add', 'OTLP-6555MK-ZZ', 1, 4),
(53999, 15, 1, 10, 'huge rows bulk add', 'OTLP-1030OS-EZ', 1, 4),
(54000, 15, 1, 10, 'huge rows bulk add', 'OTLP-1962GU-CN', 1, 4),
(54001, 15, 1, 10, 'huge rows bulk add', 'OTLP-3216WO-WV', 1, 4),
(54002, 15, 1, 10, 'huge rows bulk add', 'OTLP-9136KW-FO', 1, 4),
(54003, 15, 1, 10, 'huge rows bulk add', 'OTLP-2539TW-KZ', 1, 4),
(54004, 15, 1, 10, 'huge rows bulk add', 'OTLP-3129DW-HE', 1, 4),
(54005, 15, 1, 10, 'huge rows bulk add', 'OTLP-0556DD-HB', 1, 4),
(54006, 15, 1, 10, 'huge rows bulk add', 'OTLP-6420OR-OY', 1, 4),
(54007, 15, 1, 10, 'huge rows bulk add', 'OTLP-8429DW-HA', 1, 4),
(54008, 15, 1, 10, 'huge rows bulk add', 'OTLP-4727OX-TN', 1, 4),
(54009, 15, 1, 10, 'huge rows bulk add', 'OTLP-7079HY-OO', 1, 4),
(54010, 15, 1, 10, 'huge rows bulk add', 'OTLP-3914YK-ZR', 1, 4),
(54011, 15, 1, 10, 'huge rows bulk add', 'OTLP-5974BH-NM', 1, 4),
(54012, 15, 1, 10, 'huge rows bulk add', 'OTLP-1246OQ-CN', 1, 4),
(54013, 15, 1, 10, 'huge rows bulk add', 'OTLP-5332KS-DS', 1, 4),
(54014, 15, 1, 10, 'huge rows bulk add', 'OTLP-9531GV-YJ', 1, 4),
(54015, 15, 1, 10, 'huge rows bulk add', 'OTLP-0308WG-HR', 1, 4),
(54016, 15, 1, 10, 'huge rows bulk add', 'OTLP-3913LU-AF', 1, 4),
(54017, 15, 1, 10, 'huge rows bulk add', 'OTLP-3966BP-KQ', 1, 4),
(54018, 15, 1, 10, 'huge rows bulk add', 'OTLP-4696SQ-BB', 1, 4),
(54019, 15, 1, 10, 'huge rows bulk add', 'OTLP-7008OH-LZ', 1, 4),
(54020, 15, 1, 10, 'huge rows bulk add', 'OTLP-2254QW-XY', 1, 4),
(54021, 15, 1, 10, 'huge rows bulk add', 'OTLP-5712QK-CF', 1, 4),
(54022, 15, 1, 10, 'huge rows bulk add', 'OTLP-3389QY-KC', 1, 4),
(54023, 15, 1, 10, 'huge rows bulk add', 'OTLP-1516KM-OF', 1, 4),
(54024, 15, 1, 10, 'huge rows bulk add', 'OTLP-1598GX-BY', 1, 4),
(54025, 15, 1, 10, 'huge rows bulk add', 'OTLP-9822UJ-SF', 1, 4),
(54026, 15, 1, 10, 'huge rows bulk add', 'OTLP-5145AO-JP', 1, 4),
(54027, 15, 1, 10, 'huge rows bulk add', 'OTLP-0573TX-BG', 1, 4),
(54028, 15, 1, 10, 'huge rows bulk add', 'OTLP-0697VO-YX', 1, 4),
(54029, 15, 1, 10, 'huge rows bulk add', 'OTLP-4377JP-EH', 1, 4),
(54030, 15, 1, 10, 'huge rows bulk add', 'OTLP-7120LF-LJ', 1, 4),
(54031, 15, 1, 10, 'huge rows bulk add', 'OTLP-7620VU-EJ', 1, 4),
(54032, 15, 1, 10, 'huge rows bulk add', 'OTLP-3230WR-WQ', 1, 4),
(54033, 15, 1, 10, 'huge rows bulk add', 'OTLP-9931GT-RZ', 1, 4),
(54034, 15, 1, 10, 'huge rows bulk add', 'OTLP-5886CP-LI', 1, 4),
(54035, 15, 1, 10, 'huge rows bulk add', 'OTLP-3236UT-SX', 1, 4),
(54036, 15, 1, 10, 'huge rows bulk add', 'OTLP-8152LA-OZ', 1, 4),
(54037, 15, 1, 10, 'huge rows bulk add', 'OTLP-7004UT-IR', 1, 4),
(54038, 15, 1, 10, 'huge rows bulk add', 'OTLP-2785UW-KU', 1, 4),
(54039, 15, 1, 10, 'huge rows bulk add', 'OTLP-6708RP-KI', 1, 4),
(54040, 15, 1, 10, 'huge rows bulk add', 'OTLP-3766CL-TI', 1, 4),
(54041, 15, 1, 10, 'huge rows bulk add', 'OTLP-4532YG-KN', 1, 4),
(54042, 15, 1, 10, 'huge rows bulk add', 'OTLP-5258VW-ZQ', 1, 4),
(54043, 15, 1, 10, 'huge rows bulk add', 'OTLP-0827YQ-AP', 1, 4),
(54044, 15, 1, 10, 'huge rows bulk add', 'OTLP-5100SO-OA', 1, 4),
(54045, 15, 1, 10, 'huge rows bulk add', 'OTLP-3711RN-YL', 1, 4),
(54046, 15, 1, 10, 'huge rows bulk add', 'OTLP-1751QE-RL', 1, 4),
(54047, 15, 1, 10, 'huge rows bulk add', 'OTLP-7392ML-GP', 1, 4),
(54048, 15, 1, 10, 'huge rows bulk add', 'OTLP-1705AI-OV', 1, 4),
(54049, 15, 1, 10, 'huge rows bulk add', 'OTLP-5500QB-VE', 1, 4),
(54050, 15, 1, 10, 'huge rows bulk add', 'OTLP-4831CQ-UU', 1, 4),
(54051, 15, 1, 10, 'huge rows bulk add', 'OTLP-2020WR-VZ', 1, 4),
(54052, 15, 1, 10, 'huge rows bulk add', 'OTLP-7971AI-NQ', 1, 4),
(54053, 15, 1, 10, 'huge rows bulk add', 'OTLP-8282EK-TL', 1, 4),
(54054, 15, 1, 10, 'huge rows bulk add', 'OTLP-4381NQ-WG', 1, 4),
(54055, 15, 1, 10, 'huge rows bulk add', 'OTLP-3618XE-WO', 1, 4),
(54056, 15, 1, 10, 'huge rows bulk add', 'OTLP-7813UY-RR', 1, 4),
(54057, 15, 1, 10, 'huge rows bulk add', 'OTLP-0657WA-AN', 1, 4),
(54058, 15, 1, 10, 'huge rows bulk add', 'OTLP-7280GX-YZ', 1, 4),
(54059, 15, 1, 10, 'huge rows bulk add', 'OTLP-3325UC-XD', 1, 4),
(54060, 15, 1, 10, 'huge rows bulk add', 'OTLP-6451OF-WS', 1, 4),
(54061, 15, 1, 10, 'huge rows bulk add', 'OTLP-7745OB-MV', 1, 4),
(54062, 15, 1, 10, 'huge rows bulk add', 'OTLP-9978PV-GF', 1, 4),
(54063, 15, 1, 10, 'huge rows bulk add', 'OTLP-3480EV-YX', 1, 4),
(54064, 15, 1, 10, 'huge rows bulk add', 'OTLP-8138QE-CN', 1, 4),
(54065, 15, 1, 10, 'huge rows bulk add', 'OTLP-4443CS-DU', 1, 4),
(54066, 15, 1, 10, 'huge rows bulk add', 'OTLP-9048IH-IM', 1, 4),
(54067, 15, 1, 10, 'huge rows bulk add', 'OTLP-7324DQ-MN', 1, 4),
(54068, 15, 1, 10, 'huge rows bulk add', 'OTLP-7726PI-JQ', 1, 4),
(54069, 15, 1, 10, 'huge rows bulk add', 'OTLP-2823VT-AP', 1, 4),
(54070, 15, 1, 10, 'huge rows bulk add', 'OTLP-9403JO-NV', 1, 4),
(54071, 15, 1, 10, 'huge rows bulk add', 'OTLP-6290XD-LB', 1, 4),
(54072, 15, 1, 10, 'huge rows bulk add', 'OTLP-7863EF-YI', 1, 4),
(54073, 15, 1, 10, 'huge rows bulk add', 'OTLP-4511PW-IF', 1, 4),
(54074, 15, 1, 10, 'huge rows bulk add', 'OTLP-5003EU-SB', 1, 4),
(54075, 15, 1, 10, 'huge rows bulk add', 'OTLP-5562MR-OQ', 1, 4),
(54076, 15, 1, 10, 'huge rows bulk add', 'OTLP-0094PD-FK', 1, 4),
(54077, 15, 1, 10, 'huge rows bulk add', 'OTLP-4009UX-SX', 1, 4),
(54078, 15, 1, 10, 'huge rows bulk add', 'OTLP-7781BO-SW', 1, 4),
(54079, 15, 1, 10, 'huge rows bulk add', 'OTLP-4542MT-DP', 1, 4),
(54080, 15, 1, 10, 'huge rows bulk add', 'OTLP-1823NK-QX', 1, 4),
(54081, 15, 1, 10, 'huge rows bulk add', 'OTLP-0889GK-ME', 1, 4),
(54082, 15, 1, 10, 'huge rows bulk add', 'OTLP-8629RF-WG', 1, 4),
(54083, 15, 1, 10, 'huge rows bulk add', 'OTLP-3311QQ-IZ', 1, 4),
(54084, 15, 1, 10, 'huge rows bulk add', 'OTLP-9941FS-XI', 1, 4),
(54085, 15, 1, 10, 'huge rows bulk add', 'OTLP-3310JI-XK', 1, 4),
(54086, 15, 1, 10, 'huge rows bulk add', 'OTLP-6275FN-JQ', 1, 4),
(54087, 15, 1, 10, 'huge rows bulk add', 'OTLP-3825RF-HA', 1, 4),
(54088, 15, 1, 10, 'huge rows bulk add', 'OTLP-3957AA-TY', 1, 4),
(54089, 15, 1, 10, 'huge rows bulk add', 'OTLP-2460SF-OW', 1, 4),
(54090, 15, 1, 10, 'huge rows bulk add', 'OTLP-2190GU-HB', 1, 4),
(54091, 15, 1, 10, 'huge rows bulk add', 'OTLP-3469YA-EO', 1, 4),
(54092, 15, 1, 10, 'huge rows bulk add', 'OTLP-6239MO-VQ', 1, 4),
(54093, 15, 1, 10, 'huge rows bulk add', 'OTLP-8676KM-HW', 1, 4),
(54094, 15, 1, 10, 'huge rows bulk add', 'OTLP-5159OV-VZ', 1, 4),
(54095, 15, 1, 10, 'huge rows bulk add', 'OTLP-0225IO-ON', 1, 4),
(54096, 15, 1, 10, 'huge rows bulk add', 'OTLP-9324MF-OU', 1, 4),
(54097, 15, 1, 10, 'huge rows bulk add', 'OTLP-0415WV-FS', 1, 4),
(54098, 15, 1, 10, 'huge rows bulk add', 'OTLP-1832MW-CW', 1, 4),
(54099, 15, 1, 10, 'huge rows bulk add', 'OTLP-6614RZ-LT', 1, 4),
(54100, 15, 1, 10, 'huge rows bulk add', 'OTLP-5021WC-DV', 1, 4),
(54101, 15, 1, 10, 'huge rows bulk add', 'OTLP-1219EL-NM', 1, 4),
(54102, 15, 1, 10, 'huge rows bulk add', 'OTLP-3098AO-PI', 1, 4),
(54103, 15, 1, 10, 'huge rows bulk add', 'OTLP-9378DQ-UJ', 1, 4),
(54104, 15, 1, 10, 'huge rows bulk add', 'OTLP-3477NU-VU', 1, 4),
(54105, 15, 1, 10, 'huge rows bulk add', 'OTLP-2216JF-YP', 1, 4),
(54106, 15, 1, 10, 'huge rows bulk add', 'OTLP-1794LV-UM', 1, 4),
(54107, 15, 1, 10, 'huge rows bulk add', 'OTLP-4027II-WH', 1, 4),
(54108, 15, 1, 10, 'huge rows bulk add', 'OTLP-4189YU-ZL', 1, 4),
(54109, 15, 1, 10, 'huge rows bulk add', 'OTLP-4503AB-OT', 1, 4),
(54110, 15, 1, 10, 'huge rows bulk add', 'OTLP-5373WL-OS', 1, 4),
(54111, 15, 1, 10, 'huge rows bulk add', 'OTLP-0846LV-FE', 1, 4),
(54112, 15, 1, 10, 'huge rows bulk add', 'OTLP-8558SC-HY', 1, 4),
(54113, 15, 1, 10, 'huge rows bulk add', 'OTLP-4633KX-ZW', 1, 4),
(54114, 15, 1, 10, 'huge rows bulk add', 'OTLP-7124AD-BW', 1, 4),
(54115, 15, 1, 10, 'huge rows bulk add', 'OTLP-4002QF-NS', 1, 4),
(54116, 15, 1, 10, 'huge rows bulk add', 'OTLP-5423HJ-FF', 1, 4),
(54117, 15, 1, 10, 'huge rows bulk add', 'OTLP-0866OX-RO', 1, 4),
(54118, 15, 1, 10, 'huge rows bulk add', 'OTLP-2619NZ-YT', 1, 4),
(54119, 15, 1, 10, 'huge rows bulk add', 'OTLP-1644YB-LY', 1, 4),
(54120, 15, 1, 10, 'huge rows bulk add', 'OTLP-2273JD-MD', 1, 4),
(54121, 15, 1, 10, 'huge rows bulk add', 'OTLP-0991EH-EM', 1, 4),
(54122, 15, 1, 10, 'huge rows bulk add', 'OTLP-5321LL-FD', 1, 4),
(54123, 15, 1, 10, 'huge rows bulk add', 'OTLP-4158OP-RB', 1, 4),
(54124, 15, 1, 10, 'huge rows bulk add', 'OTLP-6805PN-UJ', 1, 4),
(54125, 15, 1, 10, 'huge rows bulk add', 'OTLP-4819AB-RW', 1, 4),
(54126, 15, 1, 10, 'huge rows bulk add', 'OTLP-1562OR-AM', 1, 4),
(54127, 15, 1, 10, 'huge rows bulk add', 'OTLP-5598WJ-ZU', 1, 4),
(54128, 15, 1, 10, 'huge rows bulk add', 'OTLP-9133QM-VJ', 1, 4),
(54129, 15, 1, 10, 'huge rows bulk add', 'OTLP-6977IV-DF', 1, 4),
(54130, 15, 1, 10, 'huge rows bulk add', 'OTLP-6584KN-EC', 1, 4),
(54131, 15, 1, 10, 'huge rows bulk add', 'OTLP-6966KO-UE', 1, 4),
(54132, 15, 1, 10, 'huge rows bulk add', 'OTLP-7330EU-RQ', 1, 4),
(54133, 15, 1, 10, 'huge rows bulk add', 'OTLP-7395EB-KE', 1, 4),
(54134, 15, 1, 10, 'huge rows bulk add', 'OTLP-4033JA-FD', 1, 4),
(54135, 15, 1, 10, 'huge rows bulk add', 'OTLP-4098CS-NY', 1, 4),
(54136, 15, 1, 10, 'huge rows bulk add', 'OTLP-0672HD-QR', 1, 4),
(54137, 15, 1, 10, 'huge rows bulk add', 'OTLP-2472YA-CP', 1, 4),
(54138, 15, 1, 10, 'huge rows bulk add', 'OTLP-1286RM-TV', 1, 4),
(54139, 15, 1, 10, 'huge rows bulk add', 'OTLP-4024LI-QJ', 1, 4),
(54140, 15, 1, 10, 'huge rows bulk add', 'OTLP-9300QC-CV', 1, 4),
(54141, 15, 1, 10, 'huge rows bulk add', 'OTLP-0066IE-RF', 1, 4),
(54142, 15, 1, 10, 'huge rows bulk add', 'OTLP-5527VR-ER', 1, 4),
(54143, 15, 1, 10, 'huge rows bulk add', 'OTLP-6515RT-TI', 1, 4),
(54144, 15, 1, 10, 'huge rows bulk add', 'OTLP-5637VW-JK', 1, 4),
(54145, 15, 1, 10, 'huge rows bulk add', 'OTLP-2780FW-MW', 1, 4),
(54146, 15, 1, 10, 'huge rows bulk add', 'OTLP-7710MT-OC', 1, 4),
(54147, 15, 1, 10, 'huge rows bulk add', 'OTLP-7234CX-EC', 1, 4),
(54148, 15, 1, 10, 'huge rows bulk add', 'OTLP-5512DP-KH', 1, 4),
(54149, 15, 1, 10, 'huge rows bulk add', 'OTLP-7208PG-YR', 1, 4),
(54150, 15, 1, 10, 'huge rows bulk add', 'OTLP-4505ED-OC', 1, 4),
(54151, 15, 1, 10, 'huge rows bulk add', 'OTLP-2516AY-UG', 1, 4),
(54152, 15, 1, 10, 'huge rows bulk add', 'OTLP-2846DK-RB', 1, 4),
(54153, 15, 1, 10, 'huge rows bulk add', 'OTLP-4046YD-GV', 1, 4),
(54154, 15, 1, 10, 'huge rows bulk add', 'OTLP-0472AZ-TX', 1, 4),
(54155, 15, 1, 10, 'huge rows bulk add', 'OTLP-4892BR-FG', 1, 4),
(54156, 15, 1, 10, 'huge rows bulk add', 'OTLP-8646MH-KN', 1, 4),
(54157, 15, 1, 10, 'huge rows bulk add', 'OTLP-6037IT-UE', 1, 4),
(54158, 15, 1, 10, 'huge rows bulk add', 'OTLP-3755AY-NR', 1, 4),
(54159, 15, 1, 10, 'huge rows bulk add', 'OTLP-2385JB-OD', 1, 4),
(54160, 15, 1, 10, 'huge rows bulk add', 'OTLP-3005GM-UN', 1, 4),
(54161, 15, 1, 10, 'huge rows bulk add', 'OTLP-3677YM-KA', 1, 4),
(54162, 15, 1, 10, 'huge rows bulk add', 'OTLP-5855ZL-LY', 1, 4),
(54163, 15, 1, 10, 'huge rows bulk add', 'OTLP-1460EX-KS', 1, 4),
(54164, 15, 1, 10, 'huge rows bulk add', 'OTLP-2996AH-MW', 1, 4),
(54165, 15, 1, 10, 'huge rows bulk add', 'OTLP-1613IO-RJ', 1, 4),
(54166, 15, 1, 10, 'huge rows bulk add', 'OTLP-4640FX-ND', 1, 4),
(54167, 15, 1, 10, 'huge rows bulk add', 'OTLP-5648YA-TP', 1, 4),
(54168, 15, 1, 10, 'huge rows bulk add', 'OTLP-2672ZV-BE', 1, 4),
(54169, 15, 1, 10, 'huge rows bulk add', 'OTLP-3727EW-TK', 1, 4),
(54170, 15, 1, 10, 'huge rows bulk add', 'OTLP-4118HU-SW', 1, 4),
(54171, 15, 1, 10, 'huge rows bulk add', 'OTLP-1728GS-OC', 1, 4),
(54172, 15, 1, 10, 'huge rows bulk add', 'OTLP-8610FW-BW', 1, 4),
(54173, 15, 1, 10, 'huge rows bulk add', 'OTLP-5770ZB-HQ', 1, 4),
(54174, 15, 1, 10, 'huge rows bulk add', 'OTLP-8861RV-SM', 1, 4),
(54175, 15, 1, 10, 'huge rows bulk add', 'OTLP-5248NT-VK', 1, 4),
(54176, 15, 1, 10, 'huge rows bulk add', 'OTLP-3199UB-BQ', 1, 4),
(54177, 15, 1, 10, 'huge rows bulk add', 'OTLP-2750OC-EN', 1, 4),
(54178, 15, 1, 10, 'huge rows bulk add', 'OTLP-2213IT-LH', 1, 4),
(54179, 15, 1, 10, 'huge rows bulk add', 'OTLP-3304VI-CS', 1, 4),
(54180, 15, 1, 10, 'huge rows bulk add', 'OTLP-6310GF-BG', 1, 4),
(54181, 15, 1, 10, 'huge rows bulk add', 'OTLP-1792XN-RJ', 1, 4),
(54182, 15, 1, 10, 'huge rows bulk add', 'OTLP-1115YF-KM', 1, 4),
(54183, 15, 1, 10, 'huge rows bulk add', 'OTLP-5058RF-DD', 1, 4),
(54184, 15, 1, 10, 'huge rows bulk add', 'OTLP-3575OP-MA', 1, 4),
(54185, 15, 1, 10, 'huge rows bulk add', 'OTLP-1289DV-LT', 1, 4),
(54186, 15, 1, 10, 'huge rows bulk add', 'OTLP-8680QV-UE', 1, 4),
(54187, 15, 1, 10, 'huge rows bulk add', 'OTLP-4090HE-PP', 1, 4),
(54188, 15, 1, 10, 'huge rows bulk add', 'OTLP-5143AT-EW', 1, 4),
(54189, 15, 1, 10, 'huge rows bulk add', 'OTLP-1401IF-WZ', 1, 4),
(54190, 15, 1, 10, 'huge rows bulk add', 'OTLP-4020FE-LL', 1, 4),
(54191, 15, 1, 10, 'huge rows bulk add', 'OTLP-9365SK-XD', 1, 4),
(54192, 15, 1, 10, 'huge rows bulk add', 'OTLP-4322ZO-KS', 1, 4),
(54193, 15, 1, 10, 'huge rows bulk add', 'OTLP-1956ZC-LC', 1, 4),
(54194, 15, 1, 10, 'huge rows bulk add', 'OTLP-7279LB-CO', 1, 4),
(54195, 15, 1, 10, 'huge rows bulk add', 'OTLP-6687IZ-TD', 1, 4),
(54196, 15, 1, 10, 'huge rows bulk add', 'OTLP-7350ID-ZM', 1, 4),
(54197, 15, 1, 10, 'huge rows bulk add', 'OTLP-8276FN-PE', 1, 4),
(54198, 15, 1, 10, 'huge rows bulk add', 'OTLP-1139EM-PC', 1, 4),
(54199, 15, 1, 10, 'huge rows bulk add', 'OTLP-7983SY-KF', 1, 4),
(54200, 15, 1, 10, 'huge rows bulk add', 'OTLP-8271YX-YV', 1, 4),
(54201, 15, 1, 10, 'huge rows bulk add', 'OTLP-7071VG-UE', 1, 4),
(54202, 15, 1, 10, 'huge rows bulk add', 'OTLP-5055TD-BN', 1, 4),
(54203, 15, 1, 10, 'huge rows bulk add', 'OTLP-4713XB-IS', 1, 4),
(54204, 15, 1, 10, 'huge rows bulk add', 'OTLP-9614OS-RS', 1, 4),
(54205, 15, 1, 10, 'huge rows bulk add', 'OTLP-3087UE-EX', 1, 4),
(54206, 15, 1, 10, 'huge rows bulk add', 'OTLP-2135YY-QP', 1, 4),
(54207, 15, 1, 10, 'huge rows bulk add', 'OTLP-6020ZM-HC', 1, 4),
(54208, 15, 1, 10, 'huge rows bulk add', 'OTLP-7705PR-XH', 1, 4),
(54209, 15, 1, 10, 'huge rows bulk add', 'OTLP-5084WI-DZ', 1, 4),
(54210, 26, 1, 5, 'rbac test', 'PU87-3865SB-CB', 1, 5),
(54211, 26, 1, 5, 'rbac test webvimark bulk', 'PU87-2604YU-GG', 1, 5),
(54212, 26, 1, 6, 'rbac test webvimark bulk', 'PU87-5165WZ-FF', 1, 5),
(54213, 26, 1, 7, 'rbac test webvimark bulk', 'PU87-2309CI-BE', 1, 5),
(54214, 26, 1, 8, 'rbac test webvimark bulk', 'PU87-7290MP-OU', 1, 5),
(54215, 26, 1, 9, 'rbac test webvimark bulk', 'PU87-2368QM-AM', 1, 5),
(54216, 26, 1, 10, 'rbac test webvimark bulk', 'PU87-5412DB-WD', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `lending`
--

CREATE TABLE `lending` (
  `id_lending` int(10) UNSIGNED NOT NULL,
  `id_unit` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lending`
--

INSERT INTO `lending` (`id_lending`, `id_unit`, `user_id`, `id_employee`, `type`, `date`) VALUES
(30, 62, 1, 3, 2, '2024-10-29'),
(31, 61, 4, 1, 2, '2024-10-29'),
(32, 60, 4, 2, 2, '2024-10-29'),
(33, 58, 5, 2, 2, '2024-10-29'),
(34, 66, 5, 1, 2, '2024-10-30'),
(35, 61, 5, 1, 2, '2024-10-30'),
(36, 64, 5, 1, 2, '2024-10-29'),
(37, 72, 8, 2, 2, '2024-10-30'),
(38, 65, 8, 3, 2, '2024-10-30'),
(39, 68, 8, 2, 2, '2024-10-30'),
(40, 70, 8, 3, 2, '2024-10-31'),
(41, 64, 8, 2, 2, '2024-10-30'),
(42, 84, 5, 4, 2, '2024-10-30'),
(43, 84, 5, 1, 2, '2024-11-07'),
(44, 64, 5, 2, 1, '2024-10-31'),
(45, 70, 5, 1, 1, '2024-10-31'),
(46, 60, 5, 1, 1, '2024-10-31'),
(47, 95, 5, 1, 1, '2024-10-31'),
(48, 95, 5, 1, 1, '2024-10-31'),
(49, 53308, 4, 2, 1, '2024-10-31'),
(50, 96, 5, 2, 1, '2024-11-07'),
(51, 88, 1, 5, 1, '2024-11-08'),
(52, 88, 1, 5, 1, '2024-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `lending_type_lookup`
--

CREATE TABLE `lending_type_lookup` (
  `id_type` tinyint(3) UNSIGNED NOT NULL,
  `type_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lending_type_lookup`
--

INSERT INTO `lending_type_lookup` (`id_type`, `type_name`) VALUES
(1, 'Item going out from warehouse '),
(2, 'Item returned to warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1729233876),
('m140608_173539_create_user_table', 1729233879),
('m140611_133903_init_rbac', 1729233879),
('m140808_073114_create_auth_item_group_table', 1729233880),
('m140809_072112_insert_superadmin_to_user', 1729233880),
('m140809_073114_insert_common_permisison_to_auth_item', 1729233880),
('m141023_141535_create_user_visit_log', 1729233880),
('m141116_115804_add_bind_to_ip_and_registration_ip_to_user', 1729233880),
('m141121_194858_split_browser_and_os_column', 1729233880),
('m141201_220516_add_email_and_email_confirmed_to_user', 1729233880),
('m141207_001649_create_basic_user_permissions', 1729233881);

-- --------------------------------------------------------

--
-- Table structure for table `status_lookup`
--

CREATE TABLE `status_lookup` (
  `id_status` tinyint(3) UNSIGNED NOT NULL,
  `status_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_lookup`
--

INSERT INTO `status_lookup` (`id_status`, `status_name`) VALUES
(1, 'Available in warehouse'),
(2, 'Borrowed/Lent'),
(3, 'In-repair'),
(4, 'Totalled or Lost');

-- --------------------------------------------------------

--
-- Table structure for table `unit_log`
--

CREATE TABLE `unit_log` (
  `id_log` int(11) NOT NULL,
  `id_unit` int(10) NOT NULL,
  `content` varchar(255) NOT NULL,
  `update_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_log`
--

INSERT INTO `unit_log` (`id_log`, `id_unit`, `content`, `update_at`) VALUES
(24, 62, 'Unit BOG-6089 lent to Tumbal', '2024-10-28 14:14:04.000000'),
(25, 58, 'Unit BOG5409 updated by tumbaladmin', '2024-10-29 08:52:07.000000'),
(26, 62, 'Unit BOG-6089 returned by Tumbal', '2024-10-29 08:56:09.000000'),
(27, 62, 'Unit BOG-6089 sent for repair by tumbaladmin', '2024-10-29 08:58:36.000000'),
(28, 62, 'Unit BOG-6089 repaired. Taken to warehouse by fradmin', '2024-10-29 09:02:13.000000'),
(29, 62, 'Unit BOG-6089 sent for repair by fradmin', '2024-10-29 09:02:42.000000'),
(30, 61, 'Unit BOG-0642 lent to johan tumbal by fradmin', '2024-10-29 09:11:57.000000'),
(31, 60, 'Unit BOG-2254 lent to Emma by fradmin', '2024-10-29 09:12:48.000000'),
(32, 61, 'Unit BOG-0642 returned by johan tumbal, recieved by fradmin', '2024-10-29 09:13:00.000000'),
(33, 61, 'Unit BOG-0642 returned by johan tumbal, recieved by fradmin', '2024-10-29 09:13:00.000000'),
(34, 60, 'Unit BOG-2254 returned by Emma, recieved by fradmin', '2024-10-29 09:14:20.000000'),
(35, 60, 'Unit BOG-2254 sent for repair by fradmin', '2024-10-29 09:16:01.000000'),
(36, 58, 'Unit BOG5409 lent to Emma by tumbaladmin', '2024-10-29 10:11:55.000000'),
(37, 58, 'Unit BOG5409 returned by Emma, recieved by tumbaladmin', '2024-10-29 10:19:15.000000'),
(38, 66, 'Unit BOG-3217 lent to johan tumbal by tumbaladmin', '2024-10-29 10:31:10.000000'),
(39, 61, 'Unit BOG-0642 lent to johan tumbal by tumbaladmin', '2024-10-29 10:31:14.000000'),
(40, 64, 'Unit BOG-0790 lent to johan tumbal by tumbaladmin', '2024-10-29 10:31:18.000000'),
(41, 64, 'Unit BOG-0790 updated by tumbaladmin', '2024-10-29 13:42:54.000000'),
(42, 64, 'Unit BOG-0790 updated by tumbaladmin', '2024-10-29 13:43:01.000000'),
(43, 64, 'Unit BOG-0790 returned by johan tumbal, recieved by tumbaladmin', '2024-10-29 13:43:17.000000'),
(44, 72, 'Unit OJW-5757 lent to Emma by fredadmin', '2024-10-30 08:42:02.000000'),
(45, 65, 'Unit BOG-0346 lent to Tumbal by fredadmin', '2024-10-30 08:42:08.000000'),
(46, 60, 'Unit BOG-2254 repaired. Taken to warehouse by fredadmin', '2024-10-30 09:03:55.000000'),
(47, 66, 'Unit BOG-3217 returned by johan tumbal, recieved by fredadmin', '2024-10-30 09:04:12.000000'),
(48, 61, 'Unit BOG-0642 returned by johan tumbal, recieved by fredadmin', '2024-10-30 09:04:26.000000'),
(49, 61, 'Unit BOG-0642 sent for repair by fredadmin', '2024-10-30 09:04:37.000000'),
(50, 66, 'Unit BOG-3217 sent for repair by fredadmin', '2024-10-30 09:04:39.000000'),
(51, 65, 'Unit BOG-0346 returned by Tumbal, recieved by fredadmin', '2024-10-30 09:10:01.000000'),
(52, 65, 'Unit BOG-0346 sent for repair by fredadmin', '2024-10-30 09:10:07.000000'),
(53, 68, 'Unit BOG-4594 lent to Emma by fredadmin', '2024-10-30 09:14:52.000000'),
(54, 70, 'Unit BOG-2006 lent to Tumbal by fredadmin', '2024-10-30 09:14:57.000000'),
(55, 72, 'Unit OJW-5757 returned by Emma, recieved by fredadmin', '2024-10-30 09:15:05.000000'),
(56, 68, 'Unit BOG-4594 returned by Emma, recieved by fredadmin', '2024-10-30 09:15:10.000000'),
(57, 64, 'Unit BOG-0790 lent to Emma by fredadmin', '2024-10-30 10:24:38.000000'),
(58, 63, 'Unit BOG-7894 updated by fradmin', '2024-10-30 11:11:53.000000'),
(59, 84, 'Unit RGT-1395 lent to Freddy by tumbaladmin', '2024-10-30 14:31:37.000000'),
(60, 84, 'Unit RGT-1395 returned by Freddy, recieved by tumbaladmin', '2024-10-30 14:31:53.000000'),
(61, 64, 'Unit BOG-0790 returned by Emma, recieved by tumbaladmin', '2024-10-30 14:32:00.000000'),
(62, 81, 'Unit BNK-9582 updated by tumbaladmin', '2024-10-30 14:37:46.000000'),
(63, 82, 'Unit BNK-1702 updated by tumbaladmin', '2024-10-30 14:38:04.000000'),
(64, 82, 'Unit BNK-1702 updated by tumbaladmin', '2024-10-30 14:40:33.000000'),
(65, 82, 'Unit BNK-1702 updated by tumbaladmin', '2024-10-30 14:42:53.000000'),
(66, 70, 'Unit BOG-2006 returned by Tumbal, recieved by tumbaladmin', '2024-10-31 09:15:27.000000'),
(67, 84, 'Unit RGT-1395 lent to johan tumbal by tumbaladmin', '2024-10-31 09:15:43.000000'),
(68, 64, 'Unit BOG-0790 lent to Emma by tumbaladmin', '2024-10-31 09:15:48.000000'),
(69, 70, 'Unit BOG-2006 lent to johan tumbal by tumbaladmin', '2024-10-31 09:15:53.000000'),
(70, 60, 'Unit BOG-2254 lent to johan tumbal by tumbaladmin', '2024-10-31 09:15:58.000000'),
(71, 95, 'Unit BOG-261 lent to johan tumbal by tumbaladmin', '2024-10-31 09:16:03.000000'),
(72, 95, 'Unit BOG-261 lent to johan tumbal by tumbaladmin', '2024-10-31 09:16:03.000000'),
(73, 95, 'Unit BOG-261 updated by tumbaladmin', '2024-10-31 09:17:30.000000'),
(74, 53308, 'Unit WX95-8225CZ-GH lent to Emma by fradmin', '2024-10-31 10:44:28.000000'),
(75, 58, 'Unit BOG5409 updated by tumbaladmin', '2024-11-07 09:57:30.000000'),
(76, 58, 'Unit BOG5409 updated by tumbaladmin', '2024-11-07 10:00:19.000000'),
(77, 58, 'Unit BOG5409 updated by tumbaladmin', '2024-11-07 10:00:41.000000'),
(78, 58, 'Unit BOG5409 updated by tumbaladmin', '2024-11-07 10:00:49.000000'),
(79, 58, 'Unit BOG5409 updated by tumbaladmin', '2024-11-07 10:01:07.000000'),
(80, 96, 'Unit BOG-914 lent to Emma by tumbaladmin', '2024-11-07 10:17:15.000000'),
(81, 84, 'Unit RGT-1395 returned by johan tumbal, recieved by tumbaladmin', '2024-11-07 10:19:24.000000'),
(82, 72, 'Unit OJW-5757 sent for repair by tumbaladmin', '2024-11-07 10:23:16.000000'),
(83, 62, 'Unit BOG-6089 repaired. Taken to warehouse by bobtherepairman', '2024-11-07 10:44:01.000000'),
(84, 88, 'Unit BOG-389 lent to Shioriiiin by superadmin', '2024-11-08 09:10:13.000000'),
(85, 88, 'Unit BOG-389 lent to Shioriiiin by superadmin', '2024-11-08 09:10:13.000000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `superadmin` smallint(6) DEFAULT 0,
  `created_at` datetime(2) NOT NULL,
  `updated_at` datetime(2) NOT NULL,
  `registration_ip` varchar(15) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `bind_to_ip` varchar(255) NOT NULL,
  `email_confirmed` int(11) NOT NULL,
  `confirmation_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password_hash`, `status`, `superadmin`, `created_at`, `updated_at`, `registration_ip`, `email`, `auth_key`, `bind_to_ip`, `email_confirmed`, `confirmation_token`) VALUES
(1, 'superadmin', '$2y$13$bp2w2.mTeJ/ORRVlEjA.jOHw0o49vwAJ.A15RTPjnSyk05M.20ZyS', 1, 1, '0000-00-00 00:00:00.00', '0000-00-00 00:00:00.00', NULL, 'super@mail.com', 'OtBMG-3O_ULHaEMKmM_pZIPvia1k_js_', '', 1, ''),
(4, 'appadmin', '$2y$13$.X94ue5lX8Yt10motmlym.HyhumhiBXBZ7leukSITV7e9sTgLjNrK', 1, 0, '2024-10-28 13:20:22.00', '0000-00-00 00:00:00.00', '::1', 'bogosbinted@mail.com', 'pUwr74uXpIAq5h1XQU-3y3PuplNbm2P8', '', 1, ''),
(5, 'franzferdinand', '$2y$13$QEUqv2hQRuKQ2uFtNfXbcuPoiz2pyiZsn1kpv3RfboEQEdA8MZC9e', 1, 0, '2024-10-28 14:32:42.00', '0000-00-00 00:00:00.00', '::1', 'ferdinand@mail.com', 'LZN0hVpdM-xAb6SA0AEALIcxiVeCAS5H', '', 1, ''),
(7, 'tumbalsekian', '$2y$13$rPtXOmHZqZ8Z1XSHkF/fvuhEi30Z45e2J6J.TqpVsq9UU.Y6Ozmoe', 1, 0, '2024-10-30 08:17:03.00', '2024-10-30 08:17:03.00', '::1', 'bogusmail@mail.com', 'IGsAN_oI96DsHjpzgo98gLc5hMd7dGJ4', '', 1, ''),
(8, 'warehouse@mail.com', '$2y$13$XZ6TofHa8d5cAMutTqSMs.QzdqeRCGMeRs3ZfqoMQCWveNyOjdTs2', 1, 0, '2024-10-30 08:40:40.00', '0000-00-00 00:00:00.00', '::1', 'fred@mail.com', 'JGU2pLcVye5PBUUqBlGuB7h1M8c6gkrx', '', 1, ''),
(9, 'bobtherepairman', '$2y$13$0FJ7ZV.5Th2sydV4mDEP2u81kx56ocrbVEFZomEzdjK6xPfRt0xGa', 1, 0, '0000-00-00 00:00:00.00', '0000-00-00 00:00:00.00', '::1', 'bobrepair@mail.com', 'MbIXLNVCI6OHZFAZgwzyyLXTeiaVd6At', '', 1, ''),
(10, 'bogosbinted', '$2y$13$byH/Orep9xl5ZWDL1IMtH.1NRxOm2IK/s9vDxODkiEp7o2gJ9TuZ2', 1, 0, '0000-00-00 00:00:00.00', '0000-00-00 00:00:00.00', '::1', 'bogosbinted@alien.com', 'LMStQ2EH_AMPtTfWSbwc9Li493FfLSTY', '', 1, ''),
(11, 'manfred', '$2y$13$S.Pu6X0K3VWvc/kr2atfyuWdDK9xYc1BMFyvHBnjKWMjJCZuUwKRG', 1, 0, '0000-00-00 00:00:00.00', '0000-00-00 00:00:00.00', '::1', 'redbaron@mail.com', 'E8fnjVCzTMoHqvXiFnfAyEEw7aU80X5W', '', 1, ''),
(12, 'hugh', '$2y$13$iREFX85Oa9udbjkKDslyy.46GR1OLNOKYh6JaiZ03pfwS59xaCnUS', 1, 0, '0000-00-00 00:00:00.00', '0000-00-00 00:00:00.00', '::1', 'hugh@mail.com', '-R2PpAC6v4_aTMieMxphBxZ3l_tgVRez', '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_visit_log`
--

CREATE TABLE `user_visit_log` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `language` char(2) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visit_time` int(11) NOT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_visit_log`
--

INSERT INTO `user_visit_log` (`id`, `token`, `ip`, `language`, `user_agent`, `user_id`, `visit_time`, `browser`, `os`) VALUES
(1, '672c16dc84d32', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1, 1730942684, 'Chrome', 'Windows'),
(2, '672c18f5e7365', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1, 1730943221, 'Chrome', 'Windows'),
(3, '672c21efda00e', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 5, 1730945519, 'Chrome', 'Windows'),
(4, '672c28a54750c', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1, 1730947237, 'Chrome', 'Windows'),
(5, '672c2c60da2ca', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1730948192, 'Chrome', 'Windows'),
(6, '672c35658ae4b', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 9, 1730950501, 'Chrome', 'Windows'),
(7, '672c37b84241f', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 9, 1730951096, 'Chrome', 'Windows'),
(8, '672c39c88e63e', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 9, 1730951624, 'Chrome', 'Windows'),
(9, '672c3a385d005', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1730951736, 'Chrome', 'Windows'),
(10, '672c3afd75f13', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1730951933, 'Chrome', 'Windows'),
(11, '672c3b5ac8bc0', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1730952026, 'Chrome', 'Windows'),
(12, '672c3b61b9b5c', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1730952033, 'Chrome', 'Windows'),
(13, '672c3be089697', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1730952160, 'Chrome', 'Windows'),
(14, '672c3dd86522e', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 10, 1730952664, 'Chrome', 'Windows'),
(15, '672c3f7005e81', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 11, 1730953072, 'Chrome', 'Windows'),
(16, '672c4196049a8', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1730953622, 'Chrome', 'Windows'),
(17, '672c41cd410d8', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', NULL, 1730953677, 'Chrome', 'Windows'),
(18, '672c41f6c5272', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 11, 1730953718, 'Chrome', 'Windows'),
(19, '672c43edd6228', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 11, 1730954221, 'Chrome', 'Windows'),
(20, '672c43ee9b9ab', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 11, 1730954222, 'Chrome', 'Windows'),
(21, '672c5e257ecb2', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1730960933, 'Chrome', 'Windows'),
(22, '672c5e6b70cba', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 11, 1730961003, 'Chrome', 'Windows'),
(23, '672c607b9de46', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 9, 1730961531, 'Chrome', 'Windows'),
(24, '672c631a85584', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 11, 1730962202, 'Chrome', 'Windows'),
(25, '672c63a2a9199', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 9, 1730962338, 'Chrome', 'Windows'),
(26, '672c64e152848', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1730962657, 'Chrome', 'Windows'),
(27, '672c64ebcb9fb', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 10, 1730962667, 'Chrome', 'Windows'),
(28, '672c66f688a01', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 9, 1730963190, 'Chrome', 'Windows'),
(29, '672c66feeaa8a', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 10, 1730963198, 'Chrome', 'Windows'),
(30, '672d65a65750b', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 1, 1731028390, 'Chrome', 'Windows'),
(31, '672d84ff293ca', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 10, 1731036415, 'Chrome', 'Windows'),
(32, '672d850843ba3', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1731036424, 'Chrome', 'Windows'),
(33, '672d86868f007', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 4, 1731036806, 'Chrome', 'Windows'),
(34, '672d8742e61f7', '::1', 'en', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 5, 1731036994, 'Chrome', 'Windows');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id_wh` int(10) UNSIGNED NOT NULL,
  `wh_name` varchar(255) NOT NULL,
  `wh_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id_wh`, `wh_name`, `wh_address`) VALUES
(5, 'schlesierland', 'somewhere in schlesierland'),
(6, 'Bavaria', 'somewhere in bavaria'),
(7, 'Brandenburg', 'somewhere in brandenburg'),
(8, 'Azores', 'somewhere in azores in the middle of atlantic ocean'),
(9, 'Samoa', 'somewhere in samoa'),
(10, 'Hugh Mongus Warehouse', 'for testing. adding units in massive bulk'),
(11, 'His Highness, His Excellency\'s Royal Storage 1', 'somewhere in a city');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`),
  ADD KEY `fk_auth_item_group_code` (`group_code`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_item_group`
--
ALTER TABLE `auth_item_group`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `condition_lookup`
--
ALTER TABLE `condition_lookup`
  ADD PRIMARY KEY (`id_condition`);

--
-- Indexes for table `doc_uploaded`
--
ALTER TABLE `doc_uploaded`
  ADD PRIMARY KEY (`id_doc`),
  ADD KEY `doc_user` (`user_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`),
  ADD UNIQUE KEY `SKU` (`SKU`);

--
-- Indexes for table `item_unit`
--
ALTER TABLE `item_unit`
  ADD PRIMARY KEY (`id_unit`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_wh` (`id_wh`),
  ADD KEY `item_unit_ibfk_1` (`status`),
  ADD KEY `item_unit_ibfk_2` (`condition`),
  ADD KEY `item_unit_user_updated` (`updated_by`);

--
-- Indexes for table `lending`
--
ALTER TABLE `lending`
  ADD PRIMARY KEY (`id_lending`),
  ADD KEY `type` (`type`),
  ADD KEY `id_unit` (`id_unit`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_employee` (`id_employee`);

--
-- Indexes for table `lending_type_lookup`
--
ALTER TABLE `lending_type_lookup`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `status_lookup`
--
ALTER TABLE `status_lookup`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `unit_log`
--
ALTER TABLE `unit_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id_wh`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `condition_lookup`
--
ALTER TABLE `condition_lookup`
  MODIFY `id_condition` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doc_uploaded`
--
ALTER TABLE `doc_uploaded`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `item_unit`
--
ALTER TABLE `item_unit`
  MODIFY `id_unit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54217;

--
-- AUTO_INCREMENT for table `lending`
--
ALTER TABLE `lending`
  MODIFY `id_lending` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `lending_type_lookup`
--
ALTER TABLE `lending_type_lookup`
  MODIFY `id_type` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_lookup`
--
ALTER TABLE `status_lookup`
  MODIFY `id_status` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unit_log`
--
ALTER TABLE `unit_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id_wh` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_auth_item_group_code` FOREIGN KEY (`group_code`) REFERENCES `auth_item_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doc_uploaded`
--
ALTER TABLE `doc_uploaded`
  ADD CONSTRAINT `doc_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_unit`
--
ALTER TABLE `item_unit`
  ADD CONSTRAINT `item_unit_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status_lookup` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_unit_ibfk_2` FOREIGN KEY (`condition`) REFERENCES `condition_lookup` (`id_condition`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_unit_ibfk_3` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_unit_ibfk_4` FOREIGN KEY (`id_wh`) REFERENCES `warehouse` (`id_wh`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `item_unit_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lending`
--
ALTER TABLE `lending`
  ADD CONSTRAINT `lending_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `item_unit` (`id_unit`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `lending_ibfk_2` FOREIGN KEY (`type`) REFERENCES `lending_type_lookup` (`id_type`),
  ADD CONSTRAINT `lending_ibfk_3` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_lending_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_visit_log`
--
ALTER TABLE `user_visit_log`
  ADD CONSTRAINT `user_visit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
