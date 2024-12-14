# Category Management System

## Purpose

We require to build a system where the admin can manage the parent-child category relationship using a single table. Below is the table structure of the category table.

## Table Structure

1. **category_id**: Unique identifier for the category.
2. **Name**: The name of the category.
3. **Status**: The status of the category. 
   - `1`: Enabled
   - `2`: Disabled
4. **Parent_id**: The ID of the parent category (null for root categories).
5. **Created Date**: The date and time when the category was created.
6. **Updated Date**: The date and time when the category was last updated (should have a value if updated at least once).

## Points to be Closed

1. **Category Grid**  
   A grid will display a list of categories with the following columns:
   - **category_id**: Unique identifier of the category.
   - **Name**: You will show the category with the full path (e.g., `Bedroom > Beds > Panel Bed`).
   - **Status**: Current status of the category (`1` - enabled, `2` - disabled).
   - **Parent_id**: ID of the parent category.
   - **Created Date**: The date and time the category was created.
   - **Updated Date**: The date and time the category was last updated.

2. **Add Category Button**  
   A button will be provided at the top to add a new category. The admin can select a parent category from a dropdown that displays the complete hierarchical path, like below:
   - Bedroom
   - Bedroom > Beds
   - Bedroom > Beds > Panel Bed
   - Bedroom > Night Stand
   - Bedroom > Dresser
   - Living Room > Sofas
   - Living Room > Loveseats
   - Living Room > Tables
   - Living Room > Tables > Coffee Table
   - Living Room > Tables > Side Table
   
   This dropdown will help the admin understand the complete hierarchy when adding or editing a category.

3. **Editing Category**  
   The category that is being edited should **not** appear in the parent category dropdown to prevent circular relationships.

4. **Change Parent Category**  
   The admin should be able to change the parent category of any existing category.

5. **Deleting Categories**  
   If any category is deleted and it has child categories, the child categories should be shifted under the parent category of the category that is being deleted.