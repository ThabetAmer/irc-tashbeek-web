import {$httpRequester} from './httpRequester';

export default {
    /**
     * GET get supported
     * @returns {Promise}
     */

    getFirms(){
        return new Promise((resolve, reject) => {
            $httpRequester
                .get(`index/firm`)
                .then(resp => {
                    resolve(resp.data);
                })
                .catch(error => {
                    console.error('Error in getting forms', error);
                    reject(error);
                });
        });

    },


}