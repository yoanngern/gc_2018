import React, {Component} from 'react';
import PropTypes from 'prop-types';
import bindAll from 'lodash/bindAll';
import {CONFIG,I18N} from '../globals/config';
import styles from './Url_Fields.pcss';

class Url_Fields extends Component {
	constructor( props ){
		super( props );
		this.state = {};
		bindAll( this, 'update_old_url', 'update_new_url' );
	}

	update_old_url( ev ){
		this.props.update_old_url( ev.target.value );
	}

	update_new_url( ev ){
		this.props.update_new_url( ev.target.value );
	}

	render(){
		let $disabled = null;
		if( this.props.old_url === '' || this.props.new_url === '' ){
			$disabled = 'disabled';
		}

		return (
			<tbody className={styles.wrap}>
			<tr>
				<th scope="row">
					<label htmlFor={CONFIG.fields.old_url}>
						{I18N.old_url}
					</label>
				</th>
				<td>
					<input
						name={CONFIG.fields.old_url}
						type="text"
						id="go-live-react-old-url-field"
						value={this.props.old_url}
						className="regular-text"
						title={I18N.old_url}
						onChange={this.update_old_url}/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label htmlFor={CONFIG.fields.new_url}>
						{I18N.new_url}
					</label>
				</th>
				<td>
					<input
						name={CONFIG.fields.new_url}
						type="text"
						id="go-live-react-new-url-field"
						value={this.props.new_url}
						className="regular-text"
						title={I18N.new_url}
						onChange={this.update_new_url}/>
				</td>
			</tr>
			<tr>
				<th/>
				<td>
					<button className="button-secondary" onClick={this.props.open_modal} disabled={$disabled} id="go-live-react-test-new-url">
						{I18N.test_new_url}
					</button>
					<p className="description regular-text">
						{I18N.test_button_instructions}
					</p>
				</td>
			</tr>
			</tbody>
		);
	}
}

Url_Fields.propTypes = {
	old_url : PropTypes.string.isRequired,
	new_url : PropTypes.string.isRequired,
	update_old_url : PropTypes.func.isRequired,
	update_new_url : PropTypes.func.isRequired,
	open_modal : PropTypes.func.isRequired,
};

Url_Fields.defaultProps = {
	old_url : '',
	new_url : '',
};


export default Url_Fields;
