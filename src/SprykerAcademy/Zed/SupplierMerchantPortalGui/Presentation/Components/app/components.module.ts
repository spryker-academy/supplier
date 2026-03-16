import { NgModule } from '@angular/core';
import { WebComponentsModule } from '@spryker/web-components';
import { ButtonLinkModule, ButtonLinkComponent } from '@spryker/button';

import { SupplierListComponent } from './supplier-list/supplier-list.component';
import { SupplierListModule } from './supplier-list/supplier-list.module';

@NgModule({
    imports: [
        // TODO: Register SupplierListComponent as a web component using WebComponentsModule.withComponents([...])
        // Hint: WebComponentsModule.withComponents([SupplierListComponent, ButtonLinkComponent])
        WebComponentsModule.withComponents([
            ButtonLinkComponent,
        ]),
        SupplierListModule,
        ButtonLinkModule,
    ],
})
export class ComponentsModule {}
