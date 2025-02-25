# Guide for Creating a New Module

1. **Copy the Necessary Files**  
   Copy one of the existing **controllers, requests, models, migrations, and views folders**. Additionally, add the necessary permissions in the `PermissionSeeder`.

2. **Use VS Code Search Function to Change Values**  
   Use the search and replace function in VS Code to change all the values in the copied files. Ensure that case sensitivity is enabled.

   Examples:
   - `MasterJenisSimulasi` -> `SimulasiGedung`
   - `master-jenis-simulasi` -> `simulasi-gedung`
   - `master_jenis_simulasi` -> `simulasi_gedung`

3. **Create Routes**  
   Copy the routes from an existing module and adjust them for the new module.

   Example:
   ```php
   // Existing routes for MasterJenisSimulasi
   Route::get('/master-jenis-simulasi/list', [MasterJenisSimulasiController::class, 'list'])->name('master-jenis-simulasi.list');
   Route::post('/master-jenis-simulasi/{master_jenis_simulasi}/update-status', [MasterJenisSimulasiController::class, 'update_status'])->name('master-jenis-simulasi.update-status');
   Route::resource('master-jenis-simulasi', MasterJenisSimulasiController::class);

   // New routes for SimulasiGedung
   Route::get('/simulasi-gedung/list', [SimulasiGedungController::class, 'list'])->name('simulasi-gedung.list');
   Route::post('/simulasi-gedung/{simulasi_gedung}/update-status', [SimulasiGedungController::class, 'update_status'])->name('simulasi-gedung.update-status');
   Route::resource('simulasi-gedung', SimulasiGedungController::class);
   ```

4. **Add Menu in The Sidebar**  
   Add the new module to the sidebar menu to ensure it is accessible from the UI. Update the sidebar menu configuration file to include the new module.

5. **Adjust as Needed**  
   Make any additional adjustments required for the new module to function correctly.

### Revision Notes:
- Ensure that all references to the old module name are updated to the new module name.
- Verify that the permissions in the `PermissionSeeder` are correctly added for the new module.
- Double-check the routes to ensure they are correctly pointing to the new controller and using the correct names.
- Ensure the new module is added to the sidebar menu for easy access.

End of guide.