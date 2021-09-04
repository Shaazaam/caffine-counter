import VueDirectives from './constants/directives';
import moment from 'moment';
import * as uiv from 'uiv'

Vue.prototype.$moment = moment;
Vue.mixin(VueMixins.global);
Vue.use(uiv);
