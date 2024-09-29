import './bootstrap';
global.feather = require('feather-icons');
global.$ = global.jQuery = require('jquery')
import DataTable from "datatables.net-dt";
import 'datatables.net-buttons-dt';
import 'datatables.net-fixedheader-dt';
import 'datatables.net-select-dt';
window.DataTable = DataTable;

require('./base/sidebar');
