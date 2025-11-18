import React from 'react';
import {
    Box,
    Button,
    Heading,
    useColorModeValue,
    VStack,
    FormControl,
    FormLabel,
    Input,
    Textarea,
    Switch,
    HStack,
    Divider,
    Text,
    Select,
    Grid,
} from '@chakra-ui/react';
import { Save } from 'lucide-react';

const Settings = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Agency Settings</Heading>
                <Button leftIcon={<Save size={20} />} colorScheme="blue">
                    Save Changes
                </Button>
            </HStack>

            <VStack spacing={6} align="stretch">
                {/* Agency Information */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Agency Information
                    </Heading>
                    <VStack spacing={5} align="stretch">
                        <FormControl>
                            <FormLabel>Agency Name</FormLabel>
                            <Input defaultValue="Prime Realty Agency" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Business Email</FormLabel>
                            <Input type="email" defaultValue="info@primerealty.com" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Phone Number</FormLabel>
                            <Input type="tel" defaultValue="+1 (555) 100-2000" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Address</FormLabel>
                            <Input defaultValue="123 Business Blvd, Suite 500" />
                        </FormControl>
                        <Grid templateColumns="repeat(3, 1fr)" gap={4}>
                            <FormControl>
                                <FormLabel>City</FormLabel>
                                <Input defaultValue="New York" />
                            </FormControl>
                            <FormControl>
                                <FormLabel>State</FormLabel>
                                <Input defaultValue="NY" />
                            </FormControl>
                            <FormControl>
                                <FormLabel>ZIP Code</FormLabel>
                                <Input defaultValue="10001" />
                            </FormControl>
                        </Grid>
                        <FormControl>
                            <FormLabel>About Agency</FormLabel>
                            <Textarea
                                rows={4}
                                defaultValue="We are a premier real estate agency serving the New York area with over 20 years of experience."
                            />
                        </FormControl>
                    </VStack>
                </Box>

                {/* Business Settings */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Business Settings
                    </Heading>
                    <VStack spacing={5} align="stretch">
                        <FormControl>
                            <FormLabel>License Number</FormLabel>
                            <Input defaultValue="RE-NY-12345678" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Tax ID / EIN</FormLabel>
                            <Input defaultValue="12-3456789" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Commission Rate (%)</FormLabel>
                            <Input type="number" defaultValue="3" step="0.1" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Realtor Commission Split (%)</FormLabel>
                            <Input type="number" defaultValue="60" />
                        </FormControl>
                    </VStack>
                </Box>

                {/* Website Settings */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Website Settings
                    </Heading>
                    <VStack spacing={5} align="stretch">
                        <FormControl>
                            <FormLabel>Custom Domain</FormLabel>
                            <Input defaultValue="www.primerealty.com" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Theme</FormLabel>
                            <Select defaultValue="modern-luxury">
                                <option value="modern-luxury">Modern Luxury</option>
                                <option value="classic-professional">Classic Professional</option>
                                <option value="coastal-breeze">Coastal Breeze</option>
                                <option value="urban-edge">Urban Edge</option>
                            </Select>
                        </FormControl>
                        <FormControl>
                            <FormLabel>Primary Color</FormLabel>
                            <Input type="color" defaultValue="#3182CE" />
                        </FormControl>
                        <HStack justify="space-between">
                            <VStack align="start" spacing={0}>
                                <Text fontWeight="semibold">Website Live</Text>
                                <Text fontSize="sm" color="gray.500">
                                    Make your website publicly accessible
                                </Text>
                            </VStack>
                            <Switch defaultChecked colorScheme="blue" />
                        </HStack>
                    </VStack>
                </Box>

                {/* Notification Settings */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Notification Settings
                    </Heading>
                    <VStack spacing={4} align="stretch">
                        <HStack justify="space-between">
                            <VStack align="start" spacing={0}>
                                <Text fontWeight="semibold">Email Notifications</Text>
                                <Text fontSize="sm" color="gray.500">
                                    Receive email updates for important events
                                </Text>
                            </VStack>
                            <Switch defaultChecked colorScheme="blue" />
                        </HStack>
                        <Divider />
                        <HStack justify="space-between">
                            <VStack align="start" spacing={0}>
                                <Text fontWeight="semibold">New Lead Alerts</Text>
                                <Text fontSize="sm" color="gray.500">
                                    Get notified when new leads are created
                                </Text>
                            </VStack>
                            <Switch defaultChecked colorScheme="blue" />
                        </HStack>
                        <Divider />
                        <HStack justify="space-between">
                            <VStack align="start" spacing={0}>
                                <Text fontWeight="semibold">Transaction Updates</Text>
                                <Text fontSize="sm" color="gray.500">
                                    Receive updates on transaction status changes
                                </Text>
                            </VStack>
                            <Switch defaultChecked colorScheme="blue" />
                        </HStack>
                        <Divider />
                        <HStack justify="space-between">
                            <VStack align="start" spacing={0}>
                                <Text fontWeight="semibold">Weekly Reports</Text>
                                <Text fontSize="sm" color="gray.500">
                                    Get weekly performance reports via email
                                </Text>
                            </VStack>
                            <Switch colorScheme="blue" />
                        </HStack>
                    </VStack>
                </Box>

                {/* Integration Settings */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Integrations
                    </Heading>
                    <VStack spacing={5} align="stretch">
                        <FormControl>
                            <FormLabel>MLS Integration</FormLabel>
                            <Select defaultValue="">
                                <option value="">Not Connected</option>
                                <option value="mls1">MLS New York</option>
                                <option value="mls2">MLS Brooklyn</option>
                            </Select>
                        </FormControl>
                        <FormControl>
                            <FormLabel>CRM Integration</FormLabel>
                            <Select defaultValue="">
                                <option value="">Not Connected</option>
                                <option value="salesforce">Salesforce</option>
                                <option value="hubspot">HubSpot</option>
                            </Select>
                        </FormControl>
                        <FormControl>
                            <FormLabel>Email Marketing</FormLabel>
                            <Select defaultValue="">
                                <option value="">Not Connected</option>
                                <option value="mailchimp">Mailchimp</option>
                                <option value="sendgrid">SendGrid</option>
                            </Select>
                        </FormControl>
                    </VStack>
                </Box>
            </VStack>
        </Box>
    );
};

export default Settings;
