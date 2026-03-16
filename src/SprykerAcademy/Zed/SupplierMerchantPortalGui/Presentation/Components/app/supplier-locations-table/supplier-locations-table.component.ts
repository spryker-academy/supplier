import { ChangeDetectionStrategy, Component, Input, ViewEncapsulation } from '@angular/core';
import { TableConfig } from '@spryker/table';

@Component({
    standalone: false,
    selector: 'mp-supplier-locations-table',
    templateUrl: './supplier-locations-table.component.html',
    changeDetection: ChangeDetectionStrategy.OnPush,
    encapsulation: ViewEncapsulation.None,
})
export class SupplierLocationsTableComponent {
    @Input() tableConfig: TableConfig;
    @Input() tableId?: string;
}
