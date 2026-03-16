import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TableModule } from '@spryker/table';

import { SupplierLocationsTableComponent } from './supplier-locations-table.component';

@NgModule({
    imports: [CommonModule, TableModule],
    declarations: [SupplierLocationsTableComponent],
    exports: [SupplierLocationsTableComponent],
})
export class SupplierLocationsTableModule {}
