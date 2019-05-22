import React from 'react';
import {ListGroup, Button} from 'react-bootstrap';
import PropTypes from 'prop-types';

export default function Styles(props) {
    const {onDelete, styleList} = props;
    if (!styleList.data) {
        return (<p>Loading data</p>)
    }
    if (styleList.data.length <= 0) {
        return (<p>Nothing to show</p>)
    }
    return (
        <ListGroup>
            {styleList.data.map(style =>
                <ListGroup.Item key={style.id}>
                    {style.name}
                    {" "}
                    <Button className="pull-right" size="sm" variant="danger" onClick={() => onDelete(style.id)}>
                        Delete
                    </Button>
                </ListGroup.Item>
            )}
        </ListGroup>
    )
}

Styles.propTypes = {
    onDelete: PropTypes.func.isRequired,
    styleList: PropTypes.object.isRequired
};
