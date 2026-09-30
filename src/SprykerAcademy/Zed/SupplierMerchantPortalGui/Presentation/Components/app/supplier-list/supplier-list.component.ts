import { ChangeDetectionStrategy, Component, Input, ViewEncapsulation } from '@angular/core';
import { TableConfig } from '@spryker/table';

@Component({
    standalone: false,
    selector: 'mp-supplier-list',
    templateUrl: './supplier-list.component.html',
    changeDetection: ChangeDetectionStrategy.OnPush,
    encapsulation: ViewEncapsulation.None,
})
export class SupplierListComponent {
    @Input() tableConfig: TableConfig;
    @Input() tableId?: string;
}
