import './bootstrap'

const headers = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    'Accept': 'application/json',
    'Content-Type': 'application/json'
}

function getFields() {
    return $('#order-form').serializeArray().reduce((obj, item) => {
        obj[item.name] = item.value;
        return obj;
    }, {});
}

function isEmptyFields() {
    const fields = getFields();

    return Object.values(fields).some((item) => {
        return item.length < 1;
    });
}

paypal.Buttons({

    onClick: (data, actions) => {
        if (isEmptyFields()) {
            alert('Please fill the form');
            return;
        }
    },

    // Call your server to set up the transaction
    createOrder: function (data, actions) {
        return fetch('/paypal/order/create/', {
            method: 'post',
            headers: headers,
            body: JSON.stringify(getFields())
        }).then((res) => {
            return res.json();
        }).then((orderData) => {
            return orderData.id;
        }).catch((error) => {
            console.log('error', error);
            return;
        });
    },

    // Call your server to finalize the transaction
    onApprove: function (data, actions) {
        return fetch('/paypal/order/' + data.orderID + '/capture/', {
            method: 'post',
            headers: headers
        }).then((res) => {
            return res.json();
        }).catch((orderData) => {
            let errorDetail = Array.isArray(orderData.details) && orderData.details[0];

            if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                return actions.restart();
            }

            if (errorDetail) {
                let msg = 'Sorry, your transaction could not be processed.';
                if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                return alert(msg); // Show a failure message (try to avoid alerts in production environments)
            }
        });
    }

}).render('#paypal-button-container');
