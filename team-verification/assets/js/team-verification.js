import { store, getContext } from '@wordpress/interactivity';

const { state, actions } = store('teamVerification', {

    state: {
        context: '',
        input: '',
        type: 'email',
        option: 'email',
        requirements: '',
        result: '',
        isError: false,
        isMistake: ''
    },

    callbacks: {
        init: () => {

            state.context = getContext();
            state.requirements = actions.socialRequirements('email');
            console.log(state.context);
            console.log(state.requirements);
        }
    },

    actions: {

        getValue: ( input ) => {

            state.input = input.target.value;

        },

        getSelect: ( select ) => {

            state.option        = select.target.value;
            state.requirements  = actions.socialRequirements( select.target.value );
            state.type          = ( select.target.value === 'email') ? 'email' : 'text';

        },

        verification: async ( event ) => {

            event.preventDefault();

            state.isLoading = true
            state.isError   = false

            document.querySelector('.team-verification__result .team-verification__result-card').innerHTML = '';

            const params = new URLSearchParams({
                action: 'team_verification',
                security: state.context.nonce,
                input: state.input,
                option: state.option,
            });

            const url = `${state.context.ajaxurl}?${params.toString()}`;

            fetch( url )
            .then( response =>  response.json() )
            .then( result => {

                state.isLoading = false;

                if ( result.data.html ) {

                    document.querySelector('.team-verification__result-card').innerHTML = result.data.html;

                } else {

                    state.isError = true;

                }
            })

        },

        socialRequirements: ( select ) => {

            let text = '';

            if( select === "email" ){
                text = 'Example email: sales@crypto.news';
            }

            if( select === "telegram" ){
                text = 'Example telegram: cryptodotnews';
            }

            if( select === "linkedin" ){
                text = 'Example linkedin: cryptodotnews';
            }

            if(select === "x" ){
                text = 'Example X: cryptodotnews';
            }

            return text ;

        }

    },

});

actions.init();
