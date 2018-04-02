import { combineReducers } from 'redux'
import results from './results'
import url from './url';

const rootReducer = combineReducers({
	results,
	url,
});

export default rootReducer