import { __ } from '@wordpress/i18n';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { TextControl, TextareaControl, Button } from '@wordpress/components';
import { plus, trash } from '@wordpress/icons';

import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
    const { title, faqs } = attributes;

    const updateFaq = (index, key, value) => {
        const newFaqs = [...faqs];
        newFaqs[index][key] = value;
        setAttributes({ faqs: newFaqs });
    };

    const addFaq = () => setAttributes({ faqs: [...faqs, { question: '', answer: '' }] });

    const removeFaq = index => {
        const newFaqs = faqs.filter((_, i) => i !== index);
        setAttributes({ faqs: newFaqs });
    };

    return (
        <div { ...useBlockProps({ className: 'kro-faq-editor-wrapper' }) }>
            <RichText
                tagName="h2"
                value={ title }
                onChange={ val => setAttributes({ title: val }) }
                placeholder={ __('Enter FAQ heading...') }
            />

            { faqs.map((faq, index) => (
                <div key={ index } className="kro-faq-editor-item">
                    <TextControl
                        label={ __('Question') }
                        value={ faq.question }
                        onChange={ val => updateFaq(index, 'question', val) }
                    />
                    <TextareaControl
                        label={ __('Answer') }
                        value={ faq.answer }
                        onChange={ val => updateFaq(index, 'answer', val) }
                    />
                    <Button 
                        isDestructive 
                        variant="link" 
                        icon={ trash } 
                        onClick={ () => removeFaq(index) }
                    >
                        { __('Delete') }
                    </Button>
                </div>
           	)) }

            <Button variant="primary" onClick={ addFaq } icon={ plus }>
                { __('Add Question') }
            </Button>
        </div>
   	);
}