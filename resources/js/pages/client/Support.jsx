import React from 'react';
import {
    Box,
    Button,
    Heading,
    useColorModeValue,
    HStack,
    VStack,
    Text,
    Grid,
    Icon,
    FormControl,
    FormLabel,
    Input,
    Textarea,
    Select,
    Accordion,
    AccordionItem,
    AccordionButton,
    AccordionPanel,
    AccordionIcon,
} from '@chakra-ui/react';
import { Mail, Phone, MessageCircle, HelpCircle, Send, MapPin } from 'lucide-react';

const ContactCard = ({ icon, title, value, action }) => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
            <VStack spacing={4}>
                <Box p={4} bg="blue.50" borderRadius="full">
                    <Icon as={icon} color="blue.600" fontSize="32px" />
                </Box>
                <VStack spacing={1}>
                    <Text fontWeight="semibold">{title}</Text>
                    <Text fontSize="sm" color="gray.600">
                        {value}
                    </Text>
                </VStack>
                <Button size="sm" colorScheme="blue" variant="outline" w="100%">
                    {action}
                </Button>
            </VStack>
        </Box>
    );
};

const Support = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const faqs = [
        {
            question: 'How do I make a payment?',
            answer: 'You can make payments through the Payments page. We accept credit cards, debit cards, and bank transfers. You can also set up automatic payments for recurring bills.',
        },
        {
            question: 'Where can I find my property documents?',
            answer: 'All your property documents are available in the Documents section. You can view, download, and organize all documents related to your properties.',
        },
        {
            question: 'How do I update my contact information?',
            answer: 'To update your contact information, go to your account settings and click on "Edit Profile". Make sure to save your changes.',
        },
        {
            question: 'Can I schedule a property viewing?',
            answer: 'Yes! Contact your assigned realtor directly through the messaging system or call our office to schedule a property viewing at your convenience.',
        },
        {
            question: 'What should I do if I need maintenance?',
            answer: 'Submit a maintenance request through the Support page or contact your property manager directly. For emergencies, please call our 24/7 emergency hotline.',
        },
        {
            question: 'How can I view my payment history?',
            answer: 'Your complete payment history is available in the Payments section. You can filter by date, property, or payment type.',
        },
    ];

    return (
        <Box>
            <Heading mb={8}>Support & Help</Heading>

            <VStack spacing={6} align="stretch">
                {/* Contact Methods */}
                <Box>
                    <Heading size="md" mb={4}>
                        Contact Us
                    </Heading>
                    <Grid templateColumns="repeat(auto-fit, minmax(200px, 1fr))" gap={6}>
                        <ContactCard
                            icon={Phone}
                            title="Call Us"
                            value="+1 (555) 100-2000"
                            action="Call Now"
                        />
                        <ContactCard
                            icon={Mail}
                            title="Email Us"
                            value="support@agency.com"
                            action="Send Email"
                        />
                        <ContactCard
                            icon={MessageCircle}
                            title="Live Chat"
                            value="Available 9 AM - 6 PM"
                            action="Start Chat"
                        />
                        <ContactCard
                            icon={MapPin}
                            title="Visit Us"
                            value="123 Business Blvd, NY"
                            action="Get Directions"
                        />
                    </Grid>
                </Box>

                {/* Contact Form */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Send Us a Message
                    </Heading>
                    <VStack spacing={5} align="stretch">
                        <Grid templateColumns="repeat(2, 1fr)" gap={4}>
                            <FormControl>
                                <FormLabel>Subject</FormLabel>
                                <Select placeholder="Select subject">
                                    <option value="payment">Payment Issue</option>
                                    <option value="document">Document Request</option>
                                    <option value="maintenance">Maintenance Request</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="other">Other</option>
                                </Select>
                            </FormControl>
                            <FormControl>
                                <FormLabel>Property (Optional)</FormLabel>
                                <Select placeholder="Select property">
                                    <option value="123-main">123 Main St</option>
                                    <option value="789-pine">789 Pine Rd</option>
                                </Select>
                            </FormControl>
                        </Grid>
                        <FormControl>
                            <FormLabel>Message</FormLabel>
                            <Textarea
                                rows={6}
                                placeholder="Please describe your question or issue in detail..."
                            />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Attachments (Optional)</FormLabel>
                            <Input type="file" multiple />
                        </FormControl>
                        <Button leftIcon={<Send size={20} />} colorScheme="blue" size="lg">
                            Send Message
                        </Button>
                    </VStack>
                </Box>

                {/* FAQ */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <HStack spacing={3} mb={6}>
                        <Icon as={HelpCircle} color="blue.500" fontSize="24px" />
                        <Heading size="md">Frequently Asked Questions</Heading>
                    </HStack>
                    <Accordion allowMultiple>
                        {faqs.map((faq, index) => (
                            <AccordionItem key={index}>
                                <AccordionButton>
                                    <Box flex="1" textAlign="left" fontWeight="semibold">
                                        {faq.question}
                                    </Box>
                                    <AccordionIcon />
                                </AccordionButton>
                                <AccordionPanel pb={4} color="gray.600">
                                    {faq.answer}
                                </AccordionPanel>
                            </AccordionItem>
                        ))}
                    </Accordion>
                </Box>

                {/* Your Realtor */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Your Assigned Realtor
                    </Heading>
                    <HStack spacing={6}>
                        <Box
                            w="80px"
                            h="80px"
                            borderRadius="full"
                            bg="blue.100"
                            display="flex"
                            alignItems="center"
                            justifyContent="center"
                        >
                            <Text fontSize="2xl" fontWeight="bold" color="blue.600">
                                SJ
                            </Text>
                        </Box>
                        <VStack align="start" flex={1} spacing={2}>
                            <Text fontSize="xl" fontWeight="bold">
                                Sarah Johnson
                            </Text>
                            <Text color="gray.600">Senior Real Estate Agent</Text>
                            <HStack spacing={4} fontSize="sm">
                                <HStack spacing={2}>
                                    <Phone size={16} />
                                    <Text>+1 (555) 123-4567</Text>
                                </HStack>
                                <HStack spacing={2}>
                                    <Mail size={16} />
                                    <Text>sarah.j@agency.com</Text>
                                </HStack>
                            </HStack>
                        </VStack>
                        <VStack spacing={2}>
                            <Button leftIcon={<Phone size={16} />} colorScheme="green" w="150px">
                                Call
                            </Button>
                            <Button leftIcon={<Mail size={16} />} colorScheme="blue" variant="outline" w="150px">
                                Email
                            </Button>
                        </VStack>
                    </HStack>
                </Box>
            </VStack>
        </Box>
    );
};

export default Support;
