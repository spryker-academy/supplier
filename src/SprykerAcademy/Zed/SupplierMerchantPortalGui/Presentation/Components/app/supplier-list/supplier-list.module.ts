import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeadlineModule } from '@spryker/headline';
import { TableModule } from '@spryker/table';

import { SupplierListComponent } from './supplier-list.component';

@NgModule({
    imports: [CommonModule, HeadlineModule, TableModule],
    declarations: [SupplierListComponent],
    exports: [SupplierListComponent],
})
export class SupplierListModule {}
