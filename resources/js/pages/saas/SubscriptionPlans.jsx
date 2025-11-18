import React from 'react';
import {
    Box,
    Button,
    Grid,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    IconButton,
    useColorModeValue,
    HStack,
    Text,
    VStack,
} from '@chakra-ui/react';
import { Plus, Edit, Trash2, Check } from 'lucide-react';

const SubscriptionPlans = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const plans = [
        {
            id: 1,
            name: 'Basic',
            price: 29,
            billing: 'monthly',
            features: ['Up to 5 realtors', '50 properties', '100 leads', 'Basic support'],
            agencies: 45,
            status: 'active',
        },
        {
            id: 2,
            name: 'Professional',
            price: 79,
            billing: 'monthly',
            features: ['Up to 20 realtors', '500 properties', 'Unlimited leads', 'Priority support'],
            agencies: 89,
            status: 'active',
        },
        {
            id: 3,
            name: 'Enterprise',
            price: 199,
            billing: 'monthly',
            features: ['Unlimited realtors', 'Unlimited properties', 'Unlimited leads', '24/7 support', 'Custom domain'],
            agencies: 22,
            status: 'active',
        },
        {
            id: 4,
            name: 'Starter (Legacy)',
            price: 19,
            billing: 'monthly',
            features: ['Up to 3 realtors', '25 properties'],
            agencies: 8,
            status: 'inactive',
        },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Subscription Plans</Heading>
                <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                    Create Plan
                </Button>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Plan Name</Th>
                            <Th>Price</Th>
                            <Th>Features</Th>
                            <Th>Active Agencies</Th>
                            <Th>Status</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {plans.map((plan) => (
                            <Tr key={plan.id}>
                                <Td fontWeight="semibold">{plan.name}</Td>
                                <Td>
                                    <Text fontWeight="bold" color="blue.600">
                                        ${plan.price}
                                    </Text>
                                    <Text fontSize="sm" color="gray.500">
                                        per {plan.billing}
                                    </Text>
                                </Td>
                                <Td>
                                    <VStack align="start" spacing={1}>
                                        {plan.features.slice(0, 3).map((feature, idx) => (
                                            <HStack key={idx} spacing={1}>
                                                <Check size={14} />
                                                <Text fontSize="sm">{feature}</Text>
                                            </HStack>
                                        ))}
                                        {plan.features.length > 3 && (
                                            <Text fontSize="sm" color="gray.500">
                                                +{plan.features.length - 3} more
                                            </Text>
                                        )}
                                    </VStack>
                                </Td>
                                <Td>{plan.agencies}</Td>
                                <Td>
                                    <Badge colorScheme={plan.status === 'active' ? 'green' : 'gray'}>
                                        {plan.status}
                                    </Badge>
                                </Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Edit size={16} />}
                                            size="sm"
                                            colorScheme="blue"
                                            variant="ghost"
                                            aria-label="Edit plan"
                                        />
                                        <IconButton
                                            icon={<Trash2 size={16} />}
                                            size="sm"
                                            colorScheme="red"
                                            variant="ghost"
                                            aria-label="Delete plan"
                                        />
                                    </HStack>
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>
            </Box>
        </Box>
    );
};

export default SubscriptionPlans;
