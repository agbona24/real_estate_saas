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

const GlobalSettings = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Global Settings</Heading>
                <Button leftIcon={<Save size={20} />} colorScheme="blue">
                    Save Changes
                </Button>
            </HStack>

            <VStack spacing={6} align="stretch">
                {/* Application Settings */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Application Settings
                    </Heading>
                    <VStack spacing={5} align="stretch">
                        <FormControl>
                            <FormLabel>Application Name</FormLabel>
                            <Input defaultValue="Real Estate SaaS Platform" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Support Email</FormLabel>
                            <Input type="email" defaultValue="support@realestate.com" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Default Language</FormLabel>
                            <Select defaultValue="en">
                                <option value="en">English</option>
                                <option value="es">Spanish</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                            </Select>
                        </FormControl>
                        <FormControl>
                            <FormLabel>Default Currency</FormLabel>
                            <Select defaultValue="USD">
                                <option value="USD">USD - US Dollar</option>
                                <option value="EUR">EUR - Euro</option>
                                <option value="GBP">GBP - British Pound</option>
                                <option value="CAD">CAD - Canadian Dollar</option>
                            </Select>
                        </FormControl>
                    </VStack>
                </Box>

                {/* Feature Flags */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Feature Flags
                    </Heading>
                    <VStack spacing={4} align="stretch">
                        <HStack justify="space-between">
                            <VStack align="start" spacing={0}>
                                <Text fontWeight="semibold">Allow New Registrations</Text>
                                <Text fontSize="sm" color="gray.500">
                                    Enable new agencies to register
                                </Text>
                            </VStack>
                            <Switch defaultChecked colorScheme="blue" />
                        </HStack>
                        <Divider />
                        <HStack justify="space-between">
                            <VStack align="start" spacing={0}>
                                <Text fontWeight="semibold">Maintenance Mode</Text>
                                <Text fontSize="sm" color="gray.500">
                                    Put the platform in maintenance mode
                                </Text>
                            </VStack>
                            <Switch colorScheme="red" />
                        </HStack>
                        <Divider />
                        <HStack justify="space-between">
                            <VStack align="start" spacing={0}>
                                <Text fontWeight="semibold">Enable AI Features</Text>
                                <Text fontSize="sm" color="gray.500">
                                    Enable AI-powered property descriptions
                                </Text>
                            </VStack>
                            <Switch defaultChecked colorScheme="blue" />
                        </HStack>
                        <Divider />
                        <HStack justify="space-between">
                            <VStack align="start" spacing={0}>
                                <Text fontWeight="semibold">Multi-language Support</Text>
                                <Text fontSize="sm" color="gray.500">
                                    Allow agencies to use multiple languages
                                </Text>
                            </VStack>
                            <Switch defaultChecked colorScheme="blue" />
                        </HStack>
                    </VStack>
                </Box>

                {/* Email Configuration */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Email Configuration
                    </Heading>
                    <VStack spacing={5} align="stretch">
                        <Grid templateColumns="repeat(2, 1fr)" gap={4}>
                            <FormControl>
                                <FormLabel>SMTP Host</FormLabel>
                                <Input defaultValue="smtp.mailgun.org" />
                            </FormControl>
                            <FormControl>
                                <FormLabel>SMTP Port</FormLabel>
                                <Input type="number" defaultValue="587" />
                            </FormControl>
                        </Grid>
                        <Grid templateColumns="repeat(2, 1fr)" gap={4}>
                            <FormControl>
                                <FormLabel>SMTP Username</FormLabel>
                                <Input defaultValue="noreply@realestate.com" />
                            </FormControl>
                            <FormControl>
                                <FormLabel>SMTP Password</FormLabel>
                                <Input type="password" defaultValue="••••••••" />
                            </FormControl>
                        </Grid>
                        <FormControl>
                            <FormLabel>From Email</FormLabel>
                            <Input type="email" defaultValue="noreply@realestate.com" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>From Name</FormLabel>
                            <Input defaultValue="Real Estate SaaS" />
                        </FormControl>
                    </VStack>
                </Box>

                {/* Payment Settings */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Payment Settings
                    </Heading>
                    <VStack spacing={5} align="stretch">
                        <FormControl>
                            <FormLabel>Stripe Publishable Key</FormLabel>
                            <Input defaultValue="pk_test_••••••••••••••••" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Stripe Secret Key</FormLabel>
                            <Input type="password" defaultValue="sk_test_••••••••••••••••" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Webhook Secret</FormLabel>
                            <Input type="password" defaultValue="whsec_••••••••••••••••" />
                        </FormControl>
                        <HStack justify="space-between">
                            <VStack align="start" spacing={0}>
                                <Text fontWeight="semibold">Test Mode</Text>
                                <Text fontSize="sm" color="gray.500">
                                    Use Stripe test environment
                                </Text>
                            </VStack>
                            <Switch defaultChecked colorScheme="blue" />
                        </HStack>
                    </VStack>
                </Box>

                {/* Storage Settings */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Storage Settings
                    </Heading>
                    <VStack spacing={5} align="stretch">
                        <FormControl>
                            <FormLabel>Storage Provider</FormLabel>
                            <Select defaultValue="s3">
                                <option value="local">Local Storage</option>
                                <option value="s3">Amazon S3</option>
                                <option value="gcs">Google Cloud Storage</option>
                                <option value="azure">Azure Blob Storage</option>
                            </Select>
                        </FormControl>
                        <FormControl>
                            <FormLabel>S3 Bucket Name</FormLabel>
                            <Input defaultValue="real-estate-saas-media" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>S3 Region</FormLabel>
                            <Input defaultValue="us-east-1" />
                        </FormControl>
                        <FormControl>
                            <FormLabel>Max File Upload Size (MB)</FormLabel>
                            <Input type="number" defaultValue="50" />
                        </FormControl>
                    </VStack>
                </Box>
            </VStack>
        </Box>
    );
};

export default GlobalSettings;
